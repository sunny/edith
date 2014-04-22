<?php
header('Content-type: text/html; charset="UTF-8"');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo h(ucfirst($this->page->name)); ?></title>
  <meta content="width=device-width" name="viewport" />
  <link rel="shortcut icon" href="<?php echo EDITH_URI ?>/public/icon.png" />
  <link rel="stylesheet" href="<?php echo EDITH_URI ?>/public/html.css" />
</head>
<body>

<?php echo MarkdownExtended($this->page->text); ?>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="public/jquery.js"><\/script>')</script>
  <script src="<?php echo EDITH_URI ?>/public/html.js"></script>
</body>
</html>
