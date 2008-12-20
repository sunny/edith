<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title><?php echo h($page->name()); ?></title>
  <link rel="shortcut icon" type="image/png" href="<?php echo EDITH_URI ?>/public/icon.png" />
  <link type="text/css" rel="stylesheet" href="<?php echo EDITH_URI ?>/public/style.css" />
  <script type="text/javascript" src="<?php echo EDITH_URI ?>/public/prototype.js"></script>
  <script type="text/javascript" src="<?php echo EDITH_URI ?>/public/script.js"></script>
</head>
<body>
  <form method="post" action="<?php echo EDITH_URI ?>/<?php echo h($page->name) ?>" id="save">
    <p>
      <textarea name="text" id="text" cols="42" rows="42"><?php echo h($page->text) ?></textarea>
      <input type="submit" id="submit" />
    </p>
  </form>
</body>
</html>
