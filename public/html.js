document.addEventListener('keydown', event => {
  if (!event.ctrlKey) return
  if (event.key != "e") return

  const href = window.location.href
  window.location = href.replace(/\.html(#.*)?/, '').replace(/\/index$/, '/')
})
