<?php
/*
 * Edith's dispatching controller.
 * RESTFULly answers to GET, HEAD, POST, PUT and DELETE to these resources:
 *   /{pagename}
 *   /{pagename}/{representation}
 */

@require 'config.php' or die('Please copy config.php.example to config.php');

// include libraries 
require 'lib/helpers.php';
require 'lib/page.class.php';

// setup request
$method = $_SERVER['REQUEST_METHOD'];
$representation = request_var('representation');
$page = new Page(request_var('name'));
$page_exists = $page->exists();

// don't allow pages with unsafe names
if (!$page->has_safe_name()) {
  header('HTTP/1.0 404 Not Found');
  exit('The page name can only contain dashes, dots and alphanumerical characters.');
}

// {pagename}/{representation}
if ($representation !== '') {

  if (!$page_exists) {
    header('HTTP/1.0 404 Not Found');
    exit('404 Not Found');
  }

  if (!isset($TEMPLATES[$representation])) {
    header('HTTP/1.0 404 Not Found');
    exit('Representation can only be one of: '.implode(array_keys($TEMPLATES), ', ')) . '.');
  }

  switch ($method) {

    case 'GET': case 'HEAD':
      header('Content-type: '.$TEMPLATES[$representation]);
      if ($method == 'GET')
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
      require 'templates/default.php';
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

