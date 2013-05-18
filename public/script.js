/* jQuery Helpers */

(function($) {

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
        return

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

  // Conditionnally ask for confirmation before closing the window
  // Takes a callback that returns the message to show or nothing.
  // Example:
  //   $(window).confirmClose(function(event) {
  //     if (true)
  //       return "Are you sure?"
  //   })
  $.fn.confirmClose = function(callback) {
    this[0].onbeforeunload = function(event) {
      var message = callback(event)
      if (!message)
        return

      // Via http://stackoverflow.com/a/2923258/311657
      if (typeof event == 'undefined')
        event = window.event

      if (event)
        event.returnValue = message

      return message
    }
  }

})(jQuery);


/* Edith */

(function(document, window, $) {

  // Edith initializer
  // Arguments:
  // - form: jQuery object containing a form with a textarea to watch
  // Example:
  //   new Edith($('form'))
  var Edith = function(form) {
    // Configure
    this.form = form
    this.textarea = form.find('textarea')
    this.changed = false
    this.saving = false
    this.favicon('black')

    // Bind events
    var that = this
    this.textarea.on('input', function() { that.onChange() })
    this.textarea.tabify()
    $(window).confirmClose(function() { return that.onConfirmClose() })
    $(window).keydown(function(e) { that.onKeydown(e) })
  }

  // Replace the current favicon with the element's text.
  // Arguments:
  // - color: to give to faviconImage.
  // Example:
  //   this.favicon("pink")
  Edith.prototype.favicon = function(color) {
    var href = this.faviconImage(this.textarea.val(), color)
    $('link[rel~=icon]').remove()
    $('head').append($('<link rel="icon" />').attr('href', href))
  }

  // Returns the data-url for image resembling a page.
  // Arguments:
  // - text: to mimic the first lines
  // - color: for these lines.
  // Example:
  //   this.faviconImage("Line1\nLine2", "orange")
  Edith.prototype.faviconImage = function(text, color) {
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

  // Redirect after all changes have been saved
  // Arguments:
  // - url: to redirect to
  // Example:
  //   this.redirect("/")
  Edith.prototype.redirect = function(url) {
    var that = this
    if (this.saving)
      setTimeout(function() { that.redirect(url) }, 100)
    else
      window.location = url
  }

  /* Events */

  Edith.prototype.onKeydown = function(e) {
    if (e.ctrlKey && String.fromCharCode(e.keyCode) == "E") {
      var href = window.location.href + '.html'
      href = href.replace(/\/.html$/, '/index.html')
      this.redirect(href)
    }
  }

  Edith.prototype.onConfirmClose = function() {
    if (this.saving || this.changed)
      return "Your last modifications didn't get saved yet."
  }

  Edith.prototype.onChange = function() {
    this.favicon('grey')
    this.changed = true
    this.checkForChange()
  }

  Edith.prototype.checkForChange = function() {
    if (this.changed && !this.saving) {
      this.changed = false
      this.save()
    }
  }

  Edith.prototype.save = function() {
    var that = this
    this.saving = true
    this.form.ajax({
      success: function() { that.onSave() },
      error: function() { that.onSaveError() }
    })
  }

  Edith.prototype.onSave = function() {
    this.saving = false
    this.checkForChange()
    if (!this.saving)
      this.favicon('black')
  }

  Edith.prototype.onSaveError = function() {
    this.saving = false
    this.checkForChange()
    if (!this.saving)
      this.favicon('red')
  }


  /* Launch */

  new Edith($('#save'))


})(document, window, jQuery);
