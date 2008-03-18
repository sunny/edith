document.observe('dom:loaded', function() {
  if ($('submit','text','save').all()) {
    $('submit').hide();
    $('text').focus();
    new Form.Observer('save', 2, function() { $('save').request() });
  }
});
