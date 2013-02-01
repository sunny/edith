// Edith
$(function() {
  var text = $('textarea')

  // Favicon
  var favicon = $('link[rel~=icon]')
  function faviconUpdate(color) {
    favicon.attr('href', paperImage(text.val(), color))
  }
  text.on('edith:saved,edith:ready', function() { faviconUpdate('black') })
  text.on('input', function() { faviconUpdate('grey') })

  // Automagic save
  text.onInterval(2, 'input', function() {
    $('form').ajax({ complete: text.trigger('edith:saved') })
  })

  // Start
  text.tabify().focus()
  text.triggerHandler('edith:ready')
})


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


// Send ajax requests to the same url, method and data as a form
// Example:
//   $('form').submit(function() {
//     $(this).ajax({ success: function() { alert('yeehah' )} })
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


// Via http://stackoverflow.com/a/6140696
$.fn.tabify = function() {
  return this.keydown(function(e) {
    // tab was pressed
    if (e.keyCode !== 9)
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
