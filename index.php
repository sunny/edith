<?php

require 'config.php';
require 'lib/helpers.php';
require 'lib/page.class.php';

// get page
$requested_name = request_var('name');
$page_name = preg_replace('#\.(html|txt)$#', '', $requested_name);
$page = new Page($page_name);
if (!$page->has_safe_name()) {
  header('HTTP/1.0 404 Not Found');
  exit('The page name can only contain dashes, dots and alphanumerical characters.');
}

switch (strtolower($_SERVER['REQUEST_METHOD'])) {

  // create or save page
  case 'post': case 'put':
    $page->text = request_var('text');
    $page->save();
    if (!is_xhr())
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit('Saved successfully!');

  // delete page
  case 'delete':
    $page->delete();
    exit;

  // show page
  case 'get':
    $page->load();
    if (preg_match('#\.html$#', $requested_name))
      require 'templates/markdown.php';
    elseif (preg_match('#\.txt$#', $requested_name))
      require 'templates/txt.php';
    else
      require 'templates/default.php';

}
