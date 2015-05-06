<?php
header('Content-type: text/html; charset="UTF-8"');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo h($page->name()); ?></title>
	<meta content="width=device-width" name="viewport" />
  <link rel="shortcut icon" href="<?php echo EDITH_URI ?>/public/icon.png" />
  <link rel="stylesheet" href="<?php echo EDITH_URI ?>/public/style.css" />
</head>
<body>

  <form method="post" action="<?php echo EDITH_URI ?>/<?php echo h($page->name) ?>" id="save">
    <textarea<?php if (mobwrite_enabled()) echo ' id="text-'.h(MOBWRITE_KEY).'-'.h($page->name).'"' ?>
      name="text" cols="42" rows="42" autocomplete="off"><?php echo h($page->text) ?></textarea>
    <input type="submit" />
  </form>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="public/vendor/jquery.js"><\/script>')</script>

  <script src="<?php echo EDITH_URI ?>/public/script.js"></script>

<?php if (mobwrite_enabled()) : ?>
  <script src="<?php echo h(MOBWRITE_URI) ?>/static/compressed_form.js"></script>
  <script>
    if (window.mobwrite) {
      mobwrite.syncGateway = '<?php echo h(MOBWRITE_URI) ?>/scripts/q.py'
      mobwrite.share('text-<?php echo h(MOBWRITE_KEY) ?>-<?php echo h($page->name) ?>')
    }
  </script>
<?php endif; ?>

</body>
</html>
