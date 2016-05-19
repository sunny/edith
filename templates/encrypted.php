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

  <form method="post" action="<?php echo EDITH_URI ?>/<?php echo h($page->name) ?>" id="save">
    <input type="password" name="password" data-encrypt-password />
    <textarea cols="42"
              rows="42"
              data-encrypt-decrypted></textarea>
    <textarea name="text"
              cols="42"
              rows="42"
              autocomplete="off"
              data-encrypt-encrypted><?php echo h($page->text) ?></textarea>
    <input type="submit" />
  </form>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="public/vendor/jquery.js"><\/script>')</script>
  <script src="<?php echo EDITH_URI ?>/public/vendor/sjcl.js"></script>
  <script src="<?php echo EDITH_URI ?>/public/encrypted.js"></script>
  <script src="<?php echo EDITH_URI ?>/public/script.js"></script>
</body>
</html>
