<?php

function h($string) {
  return htmlspecialchars($string);
}

function request_var($name) {
  if (!isset($_REQUEST[$name]))
    return '';
  return get_magic_quotes_gpc() ? stripslashes($_REQUEST[$name]) : $_REQUEST[$name];
}

function is_xhr() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    and $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function mobwrite_enabled() {
  return defined('MOBWRITE_URI') and defined('MOBWRITE_KEY')
    and MOBWRITE_URI and MOBWRITE_KEY;
}

function representations() {
  $representations = array();
  foreach (glob('templates/*.php') as $file)
    $representations[] = basename($file, '.php');
  return $representations;
}

function name_and_representation_in_url() {
  $request_uri = isset($_SERVER['RACK_REQUEST_URI']) ? $_SERVER['RACK_REQUEST_URI'] : $_SERVER['REQUEST_URI'];
  $request_uri = substr($request_uri, strlen(dirname($_SERVER['PHP_SELF'])));
  preg_match(URI_REGEX, $request_uri, $request_matches);
  return array(
    (isset($request_matches[1]) ? $request_matches[1] : ''),
    (isset($request_matches[2]) ? $request_matches[2] : ''),
  );
}
