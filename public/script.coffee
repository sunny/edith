# jQuery Helpers
# ---------------

# Indent using the tab key
# Via https://stackoverflow.com/a/6140696/311657
$.fn.tabify = ->
  @keydown (e) ->
    # tab was pressed
    return if e.keyCode != 9 or e.ctrlKey or e.shiftKey

    # get caret position/selection
    start = @selectionStart
    end = @selectionEnd
    $this = $(this)
    value = $this.val()

    # set textarea value to: text before caret + tab + text after caret
    $this.val("#{value.substring(0, start)}\t#{value.substring(end)}")

    # put caret at right position again (add one for the tab)
    @selectionStart = @selectionEnd = start + 1

    # prevent the focus lose
    e.preventDefault()

# Conditionnally ask for confirmation before closing the window
# Via https://stackoverflow.com/a/2923258/311657
# Takes a callback that returns the message to show or nothing.
# Example:
#   $(window).confirmClose(function(event) {
#     if (true)
#       return "Are you sure?"
#   })
$.fn.confirmClose = (callback) ->
  this[0].onbeforeunload = (event) ->
    message = callback(event)
    return if !message

    if typeof event == 'undefined'
      event = window.event
    if event
      event.returnValue = message

    message



# Edith
# ------


# Edith initializer
# Arguments:
# - form: jQuery object containing a form with a textarea to watch
# Example:
#   new Edith($('form'))
class Edith
  constructor: (@form) ->
    # Configure
    @textarea = @form.find('textarea')
    @changed = false
    @saving = false
    @favicon('black')
    @textarea.focus()

    # Bind events
    @textarea.on('input', @onChange)
    @textarea.tabify()
    $(window).confirmClose(@onConfirmClose)
    $(window).keydown(@onKeydown)

  # Replace the current favicon with the element's text.
  # Arguments:
  # - color: to give to faviconImage.
  # Example:
  #   this.favicon("pink")
  favicon: (color) ->
    href = @faviconImage(@textarea.val(), color)
    link = $('<link rel="icon" />').attr('href', href)
    $('link[rel~=icon]').remove()
    $('head').append(link)

  # Returns the data-url for image resembling a page.
  # Arguments:
  # - text: to mimic the first lines
  # - color: for these lines.
  # Example:
  #   this.faviconImage("Line1\nLine2", "orange")
  faviconImage: (text, color) ->
    # Prepare text
    lines = []
    text = text.split(/\n/)
    for textLine in text[0..4]
      length = $.trim(textLine).length
      length = 10 if length > 10
      lines.push $.trim(textLine).length

    # Canvas
    canvas = document.createElement('canvas')
    ctx = canvas.getContext('2d')
    canvas.width = 16
    canvas.height = 16

    # Page
    ctx.rect(1, 1, 14, 14)
    ctx.fillStyle = '#eee'
    ctx.strokeStyle = '#333'
    ctx.stroke()
    ctx.fill()

    # Lines
    ctx.strokeStyle = color
    ctx.beginPath()
    ctx.ln
    linesY = [4, 7, 10, 13]
    for length, i in lines
      ctx.moveTo(3, linesY[i])
      ctx.lineTo(3 + length, linesY[i])
    ctx.stroke()

    canvas.toDataURL("image/png")

  # Redirect after all changes have been saved
  # Arguments:
  # - url: to redirect to
  # Example:
  #   this.redirect("/")
  redirect: (url) ->
    if @saving
      setTimeout(->
        @redirect(url)
      , 100)
    else
      window.location = url

  checkForChange: ->
    if @changed && !@saving
      @changed = false
      @save()

  save: ->
    @saving = true
    text = @textarea.val()

    $.ajax
      type: if text == "" then "delete" else "put"
      url: @form.attr('action')
      data: { text: text }
      success: @onSave
      error: @onSaveError

  # Events

  onKeydown: (event) =>
    if event.ctrlKey && String.fromCharCode(event.keyCode) == "E"
      href = window.location.href
      href = href.replace(/\/$/, "/index")
      @redirect "#{href}.html"

  onConfirmClose: =>
    if @saving or @changed
      "Your last modifications didn't get saved yet."

  onChange: =>
    @favicon('grey')
    @changed = true
    @checkForChange()

  onSave: =>
    @saving = false
    @checkForChange()
    unless @saving
      @favicon('black')

  onSaveError: =>
    @saving = false
    @checkForChange()
    unless @saving
      @favicon('red')


# Start

new Edith($('#save'))
