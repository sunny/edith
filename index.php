<?php
/*
 * Edith's dispatching controller.
 * RESTFULly answers to GET, HEAD, POST, PUT and DELETE to these resources:
 *   /{pagename}
 *   /{pagename}/{representation}
 */

@include 'config.php';
if (!defined('EDITH_URI'))
  die('Please copy config.php.example to config.php');
if (!is_dir(EDITH_DATA_PATH))
  die(EDITH_DATA_PATH . " is not a directory");

// include libraries 
require 'lib/helpers.php';
require 'lib/page.class.php';


// find page and repr from request
$method = $_SERVER['REQUEST_METHOD'];
$request_uri = str_replace(dirname($_SERVER['PHP_SELF']), '', $_SERVER['REQUEST_URI']);
preg_match('#^/([^/]+?)(?:/(.+))?/?$#', $request_uri, $request_matches);

$page = new Page($request_matches[1]);
$page_exists = $page->exists();

$representation = $request_matches[2];

// don't allow pages with unsafe names
if (!$page->has_safe_name()) {
  header('HTTP/1.0 404 Not Found');
  exit('The page name can only contain dashes, dots and alphanumerical characters.');
}

// {pagename}/{representation}
if ($representation != '') {

  if (!$page_exists) {
    header('HTTP/1.0 404 Not Found');
    die("404 Not Found: $page->name");
  }

  if (!isset($TEMPLATES[$representation])) {
    header('HTTP/1.0 404 Not Found');
    $representations = implode(array_keys($TEMPLATES), ', ');
    die("Representation can only be one of: $representations.");
  }

  switch ($method) {

    case 'GET': case 'HEAD':
      header('Content-type: '.$TEMPLATES[$representation]);
      if ($method == 'HEAD')
        exit;
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

    if ($method == 'GET') {
      $page->load();
      $template = (!$page_exists or $page->is_writeable()) ? 'default' : 'html';
      require "templates/$template.php";
    }

    exit;

  case 'DELETE':
    if (!$page_exists)
      header('HTTP/1.0 404 Not Found');
    else
      $page->delete();
    exit;

  case 'PUT': case 'POST':
    $page->text = request_var('text');
    $page->save();

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

