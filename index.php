<?php
/*
 * Edith's dispatching controller.
 *
 * RESTfully answers to GET, HEAD, POST, PUT and DELETE to these resources:
 *   /{pagename}
 *   /{pagename}.{representation}
 */

@include 'config.php';
if (!defined('EDITH_URI'))
  die('Please copy config.php.example to config.php');
if (!is_dir(EDITH_DATA_PATH))
  die(EDITH_DATA_PATH . " is not a directory");

// all representations are in the templates directory
$representations = array();
foreach (glob('templates/*.php') as $file)
  $representations[] = basename($file, '.php');

// regular expression to distinguish page and extension
if (!defined('URI_REGEX'))
  define('URI_REGEX', '#^/?([^/]+?)\.?('.implode('|', $representations).')?$#');

// include libraries
require 'lib/helpers.php';
require 'lib/page.class.php';

// find page and repr from request
$method = $_SERVER['REQUEST_METHOD'];
$request_uri = substr($_SERVER['REQUEST_URI'], strlen(dirname($_SERVER['PHP_SELF'])));
preg_match(URI_REGEX, $request_uri, $request_matches);

$page = new Page(isset($request_matches[1]) ? $request_matches[1] : '');
$page_exists = $page->exists();

$representation = isset($request_matches[2]) ? $request_matches[2] : '';

// don't allow pages with unsafe names
if (!$page->has_safe_name()) {
  header('HTTP/1.0 404 Not Found');
  exit('The page name can only contain dashes, dots and alphanumerical characters.');
}

// /{pagename}.{representation}
if ($representation != '') {

  if (!$page_exists) {
    header('HTTP/1.0 404 Not Found');
    die("404 Not Found: $page->name");
  }

  if (!in_array($representation, $representations)) {
    header('HTTP/1.0 404 Not Found');
    die('Representation can only be one of: '.implode($representations, ', '));
  }

  switch ($method) {

    case 'GET': case 'HEAD':
      $page->load();
      require "templates/$representation.php";
      exit;

    case 'POST': case 'PUT': case 'DELETE':
      header('HTTP/1.0 405 Method Not Allowed');
      header('Allow: GET, HEAD');
      exit;

    default:
      header('HTTP/1.0 501 Not Implemented');
      header('Allow: GET, HEAD');
      exit;

  }
}

// /{pagename}


switch ($method) {

  case 'GET': case 'HEAD':
    if (!$page_exists)
      header('HTTP/1.0 404 Not Found');

    header('Content-type: text/html');
    $page->load();
    $template = 'default';

    if (!$page->is_writeable())
      if ($page_exists)
        $template = 'html';
      else
        die("Sorry but you cannot create new pages");

    require "templates/$template.php";
    exit;

  case 'DELETE':
    if (!$page_exists)
      header('HTTP/1.0 404 Not Found');
    else
      $page->delete();
    exit;

  case 'PUT': case 'POST':
    $page->text = request_var('text');
    try {
      $saved = $page->save();
    } catch (Exception $e) {
      $saved = $e->getMessage();
    }

    if ($saved !== true) {
      header('HTTP/1.0 500 Internal Server Error');
      die($saved ? $saved : 'Error saving page.');
    }

    if (!$page_exists)
      header('HTTP/1.0 201 Created');
    if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
      exit('Saved successfully!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

  default:
    header('HTTP/1.0 501 Not Implemented');
    header('Allow: GET, HEAD');
    exit;

}

