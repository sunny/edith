<?php

class Request {
  function url() {
    $url = isset($_SERVER['RACK_REQUEST_URI']) ? $_SERVER['RACK_REQUEST_URI'] : $_SERVER['REQUEST_URI'];
    return substr($url, strlen(dirname($_SERVER['PHP_SELF'])));
  }

  function name() {
    preg_match(URI_REGEX, self::url(), $request_matches);
    return isset($request_matches[1]) ? $request_matches[1] : '';
  }

  function representation() {
    preg_match(URI_REGEX, self::url(), $request_matches);
    $representation = isset($request_matches[2]) ? $request_matches[2] : '';
    if ($representation == 'default')
      $representation = '';
    return $representation;
  }

  function request_var($name) {
    parse_str(file_get_contents('php://input'), $request_vars);
    if (!isset($request_vars[$name]))
      return '';
    return get_magic_quotes_gpc() ? stripslashes($request_vars[$name]) : $request_vars[$name];
  }

  function is_xhr() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
      and $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }
}
