<?php
header('Content-type: text/html; charset="UTF-8"');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title><?php echo h(ucfirst($page->name)); ?></title>
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz);
    @import url(https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic);
    @import url(https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700,400italic);
    body {
      font-family: 'Droid Serif';
    }
    h1, h2, h3 {
      font-family: 'Yanone Kaffeesatz';
      font-weight: normal;
    }
    .remark-code, .remark-inline-code {
      font-family: 'Ubuntu Mono';
    }
  </style>
</head>
<body>
  <textarea id="source"><?php echo htmlspecialchars($page->text); ?></textarea>

  <script src="https://remarkjs.com/downloads/remark-latest.min.js" type="text/javascript">
  </script>
  <script type="text/javascript">
    var slideshow = remark.create();
  </script>
</body>
</html>
