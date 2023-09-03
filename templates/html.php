<?php
use Michelf\MarkdownExtra;
header('Content-type: text/html; charset="UTF-8"');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo h(ucfirst($page->name)); ?></title>
  <meta content="width=device-width" name="viewport" />
  <link rel="shortcut icon" href="<?php echo EDITH_URI ?>/public/icon.png" />
  <link rel="stylesheet" href="<?php echo EDITH_URI ?>/public/html.css" />
</head>
<body>

<?php echo MarkdownExtra::defaultTransform($page->text); ?>

  <script src="<?php echo EDITH_URI ?>/public/html.js"></script>
</body>
</html>
