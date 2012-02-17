(function() {
  var Cicada;
  var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };
  Cicada = (function() {
    function Cicada(sink, onFailure) {
      this.sink = sink;
      this.onFailure = onFailure;
      if (typeof this.onFailure !== "undefined") {
        $(document).ajaxError(this.onFailure);
      }
    }
    Cicada.prototype.log = function(obj) {
      console.log("foo");
      console.log(this.sink);
      console.log(obj);
      return jQuery.post(this.sink, obj);
    };
    Cicada.prototype.logInputs = function() {
      return $(":input").change(__bind(function(elem) {
        var target;
        target = $(elem.target);
        return this.log({
          event: "inputChange",
          value: target.val(),
          input: target.attr('name')
        });
      }, this));
    };
    return Cicada;
  })();
  window.Cicada = Cicada;
}).call(this);
