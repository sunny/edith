<?php

require 'config.php';
require 'lib/helpers.php';
require 'lib/page.class.php';

// get page name
$requestname = request_var('name');
$pagename = remove_from_end(remove_from_end($requestname, '.html'), '.txt');
$page = new Page($pagename);
if (!$page->has_safe_name()) {
  header('HTTP/1.0 404 Not Found');
  exit('The page name can only contain dashes, dots and alphanumerical characters.');
}

// create or save page
if ($_SERVER['REQUEST_METHOD'] == 'POST' or $_SERVER['REQUEST_METHOD'] == 'PUT') {
  $created = $page->is_new();
  $page->text = request_var('text');
  $page->save();
  if ($created)
    header('HTTP/1.0 201 Created');
  if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
    exit('Saved successfully!');
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit;
}

// delete page
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  $page->delete();
  exit;
}

// show page
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$page->load();
	if (ends_with($requestname, '.html'))
	  require 'templates/markdown.php';
	elseif (ends_with($requestname, '.txt'))
	  require 'templates/txt.php';
	else
	  require 'templates/default.php';
}
