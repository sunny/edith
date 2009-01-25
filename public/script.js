document.observe('dom:loaded', function() {
  $$('textarea').first().focus();
  $('submit').hide();
  new Form.Observer('save', 2, function(form) {
    form.request()
  });
});
