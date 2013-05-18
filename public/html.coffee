# Ctrl-e switches to edit mode
$(window).keydown (event) ->
  if event.ctrlKey && String.fromCharCode(event.keyCode) == "E"
    href = window.location.href.replace(/\.html/, '')
    href = href.replace(/\/index$/, '/')
    window.location = href
