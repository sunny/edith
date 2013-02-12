<?php require 'lib/markdown.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title><?php echo h(ucfirst($page->name)); ?></title>
  <link rel="shortcut icon" href="<?php echo rtrim(EDITH_URI, '/') ?>/public/icon.png" />
  <style>
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
