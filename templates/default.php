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

  <form
    method="post"
    action="<?php echo EDITH_URI ?>/<?php echo h($page->name) ?>"
    id="save"
  >
    <textarea
      autofocus
      name="text"
      cols="42"
      rows="42"
      autocomplete="off"
    ><?php echo h($page->text) ?></textarea>
    <input type="submit" />
  </form>

  <script src="<?php echo EDITH_URI ?>/public/script.js"></script>
</body>
</html>
