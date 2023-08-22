// Conditionnally ask for confirmation before closing the window
// Via https://stackoverflow.com/a/2923258/311657
// Takes a callback that returns the message to show or nothing.
const onConfirmClose = callback => {
  window.onbeforeunload = event => {
    const message = callback(event)
    if (!message) return
    if (typeof event == 'undefined') event = window.event
    if (event) event.returnValue = message
    message
  }
}

// Returns the data-url for image resembling a page.
const faviconImage = (text, color) => {
  const lines = text.split(/\n/).slice(0, 4)

  const canvas = document.createElement("canvas")
  canvas.width = 16
  canvas.height = 16

  // Page
  ctx = canvas.getContext("2d")
  ctx.rect(1, 1, 14, 14)
  ctx.fillStyle = "#eee"
  ctx.strokeStyle = "#333"
  ctx.stroke()
  ctx.fill()

  // Lines
  ctx.strokeStyle = color
  ctx.beginPath()
  ctx.ln
  const linesY = [4, 7, 10, 13]
  lines.forEach((line, index) => {
    const length = line.trim().length
    ctx.moveTo(3, linesY[index])
    ctx.lineTo(3 + length, linesY[index])
  })
  ctx.stroke()

  return canvas.toDataURL("image/png")
}

class EdithForm {
  constructor() {
    this.form = document.getElementById("save");
    this.textarea = this.form.querySelector("textarea");
    this.changed = false;
    this.saving = false;

    this.textarea.addEventListener("input", this.onChange);
    window.addEventListener("keydown", this.onKeydown);
    onConfirmClose(this.onConfirmClose);

    this.updateFavicon("black");
  }

  // Replace the current favicon with the element’s text.
  updateFavicon(color) {
    const link = document.createElement("link");
    link.rel = "icon";
    link.href = faviconImage(this.textarea.value, color);
    document.querySelector("link[rel~=icon]").remove();
    document.head.appendChild(link);
  }

  // Redirect after all changes have been saved
  // Arguments:
  // - url: to redirect to
  // Example:
  //   this.redirect("/")
  redirect(url) {
    if (this.saving) {
      setTimeout(() => this.redirect(url), 100);
    } else {
      window.location = url;
    }
  }

  save() {
    this.saving = true;
    const text = this.textarea.value;
    const options = {
      method: text == "" ? "DELETE" : "PUT",
      body: new URLSearchParams({ text: text }),
      headers: {
        "X-Requested-With": "XMLHttpRequest",
      },
    };

    fetch(this.form.action, options)
      .then(this.onSave)
      .catch(this.onSaveError)
  }

  // Events

  onKeydown = (event) => {
    if (event.ctrlKey && event.key == "e") {
      this.redirect(window.location.href.replace(/\/$/, "/index") + ".html");
    }
  };

  onConfirmClose = () => {
    if (this.saving || this.changed) {
      return "Your last modifications didn't get saved yet.";
    }
  };

  onChange = () => {
    this.updateFavicon("grey");
    this.changed = true;
    this.checkForChange();
  };

  onSave = () => {
    this.saving = false;
    this.checkForChange();
    if (!this.saving) this.updateFavicon("black");
  };

  onSaveError = () => {
    this.saving = false;
    this.checkForChange();
    if (!this.saving) this.updateFavicon("red");
  };

  checkForChange() {
    if (this.changed && !this.saving) {
      this.changed = false;
      this.save();
    }
  }
}

// Start
new EdithForm()
