<?php
/*
 * Edith
 * by Sunny Ripert http://sunfox.org/
 * Licenced under the GPL http://www.gnu.org/copyleft/gpl.html
 */

define('EDITH_URI', '/edith'); // no trailing slash
define('EDITH_DATA_PATH', 'data');

require 'includes/helpers.php';
require 'includes/page.class.php';

$requestname = request_var('name');
$pagename = remove_from_end(remove_from_end($requestname, '.html'), '.txt');
$page = new Page($pagename);

if (!$page->has_safe_name()) {
  header('HTTP/1.0 404 Not Found');
  exit('The page name can only contain dashes, dots and alphanumerical characters.');
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
  require 'templates/markdown.php';
elseif (ends_with($requestname, '.txt'))
  require 'templates/txt.php';
else
  require 'templates/default.php';


