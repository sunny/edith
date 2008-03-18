<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>Edit <?php echo h($page->name()); ?></title>
  <link rel="shortcut icon" type="image/png" href="includes/icon.png" />
  <link type="text/css" rel="stylesheet" href="includes/style.css" />
  <script type="text/javascript" src="includes/prototype.js"></script>
  <script type="text/javascript" src="includes/script.js"></script>
</head>
<body>
  <form method="post" action="." id="save">
    <p>
      <textarea name="text" id="text" cols="42" rows="42"><?php echo h($page->text) ?></textarea>
      <input type="hidden" name="name" value="<?php echo h($page->name) ?>" />
      <input type="submit" id="submit" />
    </p>
  </form>
</body>
</html>
