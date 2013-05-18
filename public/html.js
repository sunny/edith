// Hotkey ctrl-e switches to edit mode
$(window).keydown(function(e) {
  if (e.ctrlKey && String.fromCharCode(e.keyCode) == "E") {
    var href = window.location.href.replace(/\.html/, '')
    href = href.replace(/\/index$/, '/')
    window.location = href
  }
})
