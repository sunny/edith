document.observe('dom:loaded', function() {
  if ($('submit','text','save').all()) {
    $('text').focus();
    $('submit').hide();
    new Form.Observer('save', 2, function(form) {
      form.request()
    });
  }
});
