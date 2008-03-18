<?php

function ends_with($name, $end) {
  return $name == $end or 0 === strpos(strrev($name), strrev($end));
}

function h($string) {
  return htmlspecialchars($string);
}

function remove_from_end($name, $end) {
  if (ends_with($name, $end))
    return substr($name, 0, strlen($name) - strlen($end));
  return $name;
}

function request_var($name) {
  if (!isset($_REQUEST[$name]))
    return '';
  return get_magic_quotes_gpc() ? stripslashes($_REQUEST[$name]) : $_REQUEST[$name];
}

