<?php
header('Content-type: text/html; charset="UTF-8"');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta content="width=device-width" name="viewport" />
  <title><?php echo h(ucfirst($page->name)); ?></title>
  <link rel="shortcut icon" href="<?php echo EDITH_URI ?>/public/icon.png" />
  <link rel="stylesheet" href="<?php echo EDITH_URI ?>/public/html.css" />
</head>
<body>

<?php echo MarkdownExtended($page->text); ?>

  <script src="<?php echo EDITH_URI ?>/public/html.js"></script>
</body>
</html>
