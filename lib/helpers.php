<?php

function h($string) {
  return htmlspecialchars($string);
}

function starts_with($hay, $needle) {
  return substr($hay, 0, strlen($needle)) === $needle;
}

function request_var($name) {
  parse_str(file_get_contents("php://input"), $request_vars);
  if (!isset($request_vars[$name])) return '';

  return $request_vars[$name];
}

function is_xhr() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    and $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function mobwrite_enabled() {
  return defined('MOBWRITE_URI') and defined('MOBWRITE_KEY')
    and MOBWRITE_URI and MOBWRITE_KEY;
}

// Current URI without Edith’s directory
function request_uri() {
  // Request URI from server
  $request_uri = $_SERVER['REQUEST_URI'];

  // Remove Edith’s directory
  $dir = dirname($_SERVER['PHP_SELF']);
  if (starts_with($request_uri, $dir)) {
    $request_uri = substr($request_uri, strlen($dir));
  }

  return $request_uri;
}

// Returns an array with the page name and the representation for the current
// request URL.
//
// Examples:
// - "/" => array('', '')
// - "/foo.txt" => array('foo', 'txt')
function name_and_representation_in_url() {
  preg_match(URI_REGEX, request_uri(), $request_matches);
  return array(
    (isset($request_matches[1]) ? $request_matches[1] : ''),
    (isset($request_matches[2]) ? $request_matches[2] : ''),
  );
}
