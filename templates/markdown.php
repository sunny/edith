<?php require 'includes/markdown.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title><?php echo h(ucfirst($page->name)); ?></title>
  <link rel="shortcut icon" type="image/png" href="<?php echo EDITH_PATH ?>/public/icon.png" />
  <style type="text/css">
    body {
      padding:1em;
      font:1em Lucida Grande, Helvetica, Arial, sans-serif;
    }
  </style>
</head>
<body>

<?php echo Markdown($page->text); ?>

</body>
</html>
