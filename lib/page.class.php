<?php

class Page {
  function __construct($name = '') {
    $this->name = $name ? $name : 'index';
    $this->text = '';
  }

  function filepath() {
    return dirname(__FILE__) . '/../' . EDITH_DATA_PATH . '/' . str_replace('.', '_', $this->name) . '.txt';
  }

  function name() {
    $name = str_replace('_', ' ', $this->name);
    $name = str_replace('-', ' ', $name);
    $name = ucwords($name);
    return $name;
  }

  function has_safe_name() {
    return preg_match("/^[a-z0-9-._ ]+$/i", $this->name);
  }

  function exists() {
    return is_file($this->filepath());
  }

  function load() {	
    $this->text = 'Edit me!';
    if ($this->exists())
      $this->text = file_get_contents($this->filepath());
  }

  function save() {
    if ($this->text == '') {
      if ($this->exists())
        $this->delete(); // delete empty files
      return;
    }

    $handle = @fopen($this->filepath(), 'w') or die('Error saving page.');
    @fwrite($handle, $this->text) or die('Error saving page.');
    fclose($handle);
  }

  function delete() {
    return unlink($this->filepath());
  }

  function is_writeable() {
    return is_writeable($this->filepath());
  }
}

