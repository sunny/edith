<?php

class View {
  function __construct($page) {
    $this->page = $page;
  }

  function render($template) {
    require "templates/$template.php";
  }
}
