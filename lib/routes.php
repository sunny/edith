<?php

list($name, $representation) = name_and_representation_in_url();

$page = new Page($name);
$page_exists = $page->exists();

// Don't allow unsafe page names
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

  $representations = representations();
  if (!in_array($representation, $representations)) {
    header('HTTP/1.0 404 Not Found');
    die('Representation can only be one of: '.implode($representations, ', '));
  }

  switch ($_SERVER['REQUEST_METHOD']) {

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


switch ($_SERVER['REQUEST_METHOD']) {

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

