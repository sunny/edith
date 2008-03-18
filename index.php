<?php
/*
 * Edit
 * by Sunny Ripert http://sunfox.org/
 * Licenced under the GPL http://www.gnu.org/copyleft/gpl.html
 */

define('DATA_PATH', 'data/');

require 'includes/helpers.php';
require 'includes/page.class.php';

$requestname = request_var('name');
$page = new Page(remove_from_end(remove_from_end($requestname, '.html'), '.txt'));

if (!$page->has_safe_name()) {
  header('HTTP/1.0 404 Not Found');
  exit('Le nom de page ne peut contenir que des tirets, points ou alphanumeriques.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' or $_SERVER['REQUEST_METHOD'] == 'PUT') {
  $is_new = $page->is_new();
  $page->text = request_var('text');
  $page->save();
  if ($is_new)
    header('HTTP/1.0 201 Created');
  if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' or $_SERVER['REQUEST_METHOD'] == 'PUT')
    exit('Saved successfully!');
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  $page->delete();
  exit;
}


$page->load();
if (ends_with($requestname, '.html'))
  require 'markdown_template.php';
elseif (ends_with($requestname, '.txt'))
  require 'txt_template.php';
else
  require 'edit_template.php';


