<?php
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

<script type="text/vnd.graphviz" id="graph-source">
<?php echo $page->text; ?>
</script>

<div id="graph-svg"></div>

<script src="<?php echo EDITH_URI ?>/public/vendor/viz.js"></script>
<script>
  var src = document.getElementById('graph-source').innerHTML;
  var result = Viz(src, "svg", "dot");
  document.getElementById('graph-svg').innerHTML = result;
</script>

</body>
</html>
