class Cicada
  constructor: (@sink, @onFailure) ->
    # Give the option of failure
    if typeof @onFailure != "undefined"
      $(document).ajaxError(@onFailure)

  log: (obj) ->
    jQuery.post(@sink, obj)

  logInputs: () ->
    $(":input").change( (elem) =>
      target = $(elem.target)
      @.log({
        event: "inputChange"
        value: target.val()
        name: target.attr('name')
        id: target.attr('id')
      })
    )

window.Cicada = Cicada
