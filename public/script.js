// Edith
$(function() {
  var text = $('textarea')

  // Automagic save
  text.on('input', function() { text.data('change', true) })
  setInterval(function() {
    if (text.data('change')) $('form').ajax()
    text.data('change', false)
  }, 2e3)

  // Favicon
  text.textFavicon('black')
  text.on('input', function() { text.textFavicon('grey') })
  $(document).ajaxComplete(function() { if (!text.data('change')) text.textFavicon('black') })
             .ajaxError(function() { if (!text.data('change')) text.textFavicon('red') })

  // Indentation
  text.tabify().focus()

  // Don't close the browser if any modification is waiting
  confirmClose(function() {
    if (text.data('change'))
      return "Your last modifications didn't get saved yet.";
  })

  // Hotkey ctrl-e switches to HTML mode
  $(window).keydown(function(e) {
    if (e.ctrlKey && String.fromCharCode(e.keyCode) == "E") {
      var href = window.location.href + '.html'
      href = href.replace(/\/.html$/, '/index.html')
      window.location = href
    }
  })

})

// Replace the current favicon with the element's text, using paperImage
$.fn.textFavicon = function(color) {
  var href = paperImage(this.val(), color)
  $('link[rel~=icon]').remove()
  $('head').append($('<link rel="icon" />').attr('href', href))
}

// Returns the data-url for image resembling a page. Takes a text to mimic lines.
function paperImage(text, color) {
  // Prepare text
  var lines = []
  text = text.split(/\n/)
  for (var i = 0; i <= 4; i++)
    if (typeof text[i] !== "undefined")
      lines.push($.trim(text[i]).length)

  // Canvas
  var canvas = document.createElement('canvas'),
      ctx = canvas.getContext('2d')
  canvas.width = 16
  canvas.height = 16

  // Page
  ctx.rect(1, 1, 14, 14)
  ctx.fillStyle = '#eee'
  ctx.strokeStyle = '#333'
  ctx.stroke()
  ctx.fill()

  // Lines
  ctx.strokeStyle = color
  ctx.beginPath()
  ctx.ln
  var linesY = [4, 7, 10, 13]
  for (var i = 0, _length = lines.length; i < _length; i++) {
    var length = lines[i] > 10 ? 10 : lines[i]
    ctx.moveTo(3, linesY[i])
    ctx.lineTo(3 + length, linesY[i])
  }
  ctx.stroke()

  return canvas.toDataURL("image/png")
}

// Conditionnally ask for confirmation before closing the window
// Takes a callback that returns the message to show or nothing.
// Example:
//   confirmClose(function(event) {
//     if (true)
//       return "Are you sure?"
//   })
function confirmClose(callback) {

  window.onbeforeunload = function(event) {
    var message = callback(event)
    if (!message)
      return;

    // Via http://stackoverflow.com/a/2923258/311657
    if (typeof event == 'undefined')
      event = window.event

    if (event)
      event.returnValue = message

    return message
  }
}

// Call a callback if the given event name has occured since the given seconds
// Example:
//   $('input').onInterval(5, 'keyup', function() {
//     alert('you did a keyup in that field in the last 5 seconds')
//   })
$.fn.onInterval = function(seconds, bind, callback) {
  return this.each(function() {
    var self = this,
        change = false

    $(self).on(bind, function() {
      change = true
    })
    setInterval(function() {
      if (change) {
        callback.call(self)
        change = false
      }
    }, seconds * 1000)
  })
}


// Send ajax requests to the same url, method and data as a <form>
// Example:
//   $('form').submit(function() {
//     $(this).ajax({ success: function() { alert('yeeha!' )} })
//   })
// Via https://github.com/cosmic/cosmic-js/blob/master/cosmic.jquery.js
$.fn.ajax = function(options) {
  return $(this).each(function() {
    var defaultOptions = {
      type: $(this).attr('method'),
      url: $(this).attr('action'),
      data: $(this).serialize(),
    }
    return $.ajax($.extend(defaultOptions, options))
  })
}

// Indent using the tab key
// Via http://stackoverflow.com/a/6140696
$.fn.tabify = function() {
  return this.keydown(function(e) {
    // tab was pressed
    if (e.keyCode !== 9 || e.ctrlKey || e.shiftKey)
      return;

    // get caret position/selection
    var start = this.selectionStart,
        end = this.selectionEnd,
        $this = $(this),
        value = $this.val()

    // set textarea value to: text before caret + tab + text after caret
    $this.val(value.substring(0, start)
                + "\t"
                + value.substring(end))

    // put caret at right position again (add one for the tab)
    this.selectionStart = this.selectionEnd = start + 1

    // prevent the focus lose
    e.preventDefault()
  })
}
