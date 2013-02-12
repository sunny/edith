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
