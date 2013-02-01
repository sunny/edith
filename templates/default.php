<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo h($page->name()); ?></title>
  <link rel="shortcut icon" href="<?php echo EDITH_URI ?>/public/icon.png" />
  <link rel="stylesheet" href="<?php echo EDITH_URI ?>/public/style.css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="http://edith-mobwrite.appspot.com/static/compressed_form.js"></script>
  <script src="<?php echo EDITH_URI ?>/public/script.js"></script>
</head>
<body>

  <form method="post" action="<?php echo EDITH_URI ?>/<?php echo h($page->name) ?>">
    <textarea name="text" cols="42" rows="42" autocomplete="off"><?php echo h($page->text) ?></textarea>
    <input type="submit" />
  </form>

<?php if (defined('MOBWRITE_URI') and defined('MOBWRITE_KEY')
    and MOBWRITE_URI and MOBWRITE_KEY) : ?>
  <script>
    mobwrite.syncGateway = '<?php echo h(MOBWRITE_URI) ?>'
    mobwrite.share('<?php echo MOBWRITE_KEY ?>-<?php echo $page->name ?>')
  </script>

<?php endif; ?>
</body>
</html>
