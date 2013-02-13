<?php
header('Content-type: text/html; charset="UTF-8"');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo h(ucfirst($page->name)); ?></title>
  <link rel="shortcut icon" href="<?php echo EDITH_URI ?>/public/icon.png" />
  <style>
    body {
      padding: 1em;
      font: 1em Lucida Grande, Helvetica, Arial, sans-serif;
    }
  </style>
</head>
<body>

<?php echo Markdown($page->text); ?>

</body>
</html>
