<?php

class Router {
  function __construct() {
    $this->request = new Request();
    $this->representation = $this->request->representation();
    $this->page = new Page($this->request->name());
  }

  function route() {
    if (!$this->page->has_safe_name())
      $this->not_found('The page name can only contain dashes, dots and alphanumerical characters.');

    if ($this->representation != '')
      $this->route_representation();
    else
      $this->route_page();
  }

  // /{pagename}.{representation}
  function route_representation() {
    global $REPRESENTATIONS;

    if (!$this->page->exists())
      $this->not_found("404 Not Found: $this->page->name");

    if (!in_array($this->representation, $REPRESENTATIONS))
      $this->not_found('Representation can only be one of: '.implode($REPRESENTATIONS, ', '));

    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET': case 'HEAD':
        $this->get_representation();

      case 'POST': case 'PUT': case 'PATCH': case 'DELETE':
        header('HTTP/1.0 405 Method Not Allowed');
        header('Allow: GET, HEAD');
        exit;

      default:
        header('HTTP/1.0 501 Not Implemented');
        header('Allow: GET, HEAD');
        exit;
    }
  }

  function get_representation() {
    $this->page->load();
    $view = new View($this->page);
    $view->render($this->representation);
    exit;
  }

  // /{pagename}
  function route_page() {
    switch ($_SERVER['REQUEST_METHOD']) {

      case 'GET': case 'HEAD':
        $this->get_page();

      case 'PUT': case 'POST': case 'PATCH':
        $this->put_page();

      case 'DELETE':
        $this->delete_page();

      default:
        header('HTTP/1.0 501 Not Implemented');
        header('Allow: GET, HEAD, PUT, DELETE');
        exit;

    }
  }

  function get_page() {
    if (!$this->page->exists())
      header('HTTP/1.0 404 Not Found');

    header('Content-type: text/html');
    $this->page->load();
    $template = 'default';

    if (!$this->page->is_writeable())
      if ($this->page->exists())
        $template = 'html';
      else
        die("Sorry but you cannot create new pages");

    require "templates/$template.php";
    exit;
  }

  function put_page() {
    $this->page->text = request_var('text');

    try {
      $saved = $this->page->save();
    } catch (Exception $e) {
      $saved = $e->getMessage();
    }

    if ($saved !== true) {
      header('HTTP/1.0 500 Internal Server Error');
      die($saved ? $saved : 'Error saving page.');
    }

    if (!$this->page->exists())
      header('HTTP/1.0 201 Created');

    if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
      exit('Saved successfully!');

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  function delete_page() {
    if (!$this->page->exists())
      $this->not_found();

    $this->page->delete();
    exit;
  }

  function not_found($msg = '') {
    header('HTTP/1.0 404 Not Found');
    exit($msg);
  }
}
