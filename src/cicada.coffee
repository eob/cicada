class Cicada
  constructor: (@sink, @onFailure) ->
    # Give the option of failure
    if typeof @onFailure != "undefined"
      $(document).ajaxError(@onFailure)

  log: (obj) ->
    console.log("foo")
    console.log(@sink)
    console.log(obj)
    jQuery.post(@sink, obj)

  logInputs: () ->
    $(":input").change( (elem) =>
      target = $(elem.target)
      @.log({
        event: "inputChange"
        value: target.val()
        input: target.attr('name')
      })
    )

window.Cicada = Cicada
