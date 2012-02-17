<?php
/*
 * Cicada Server
 * Ted Benson <eob@csail.mit.edu>
 * Created: 16 Feb 2012
 *
 * Simple logging sink for the client-side bug
 */

require_once("variables.inc.php");

/*
 * Check Cookies
 */

$userId = $_COOKIE[$COOKIE_NAME];
$newCookie = false;

if ($userId == null) {
  $newCookie = true;
  $lifespan = time()+60*60*24*$COOKIE_LIFE_DAYS;
  $userId = $_SERVER['REMOTE_ADDR'] . "-" . rand(0,1000000000);
  setcookie($COOKIE_NAME, $userId, $lifespan, '/');
}

/*
 * Log the entry
 */

$logEntry = array(
  "referer" => $_SERVER['HTTP_REFERER'],
  "ip" => $_SERVER['REMOTE_ADDR'],
  "time" => time(),
  "cookie" => $userId,
  "newCookie" => $newCookie,
  "post" => $_POST
);

$json = json_encode($logEntry);

file_put_contents($OUTPUT_FILE, $json, FILE_APPEND | LOCK_EX);

/*
 * Craft Response
 */

header("Content-type: text/javascript");
header("X-XSS-Protection: 0");
echo "";

?>
