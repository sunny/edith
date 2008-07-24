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
  return $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}
