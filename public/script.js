// Edith
$(function() {
  $('#submit').hide()
  $('textarea')
    .focus()
    .tabsPlease()
    .onInterval(2, 'input', function() {
      $('form').ajax()
    })
})

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
$.fn.tabsPlease = function() {
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
