<?php

class Page {
  function __construct($name = '') {
    $this->name = $name ? $name : 'index';
    $this->text = '';
  }
  function filename() {
    return DATA_PATH . str_replace('.', '_', $this->name) . '.txt';
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
  function is_new() {
    return !is_file($this->filename());
  }
  function load() {	
    $this->text = 'Edit me!';
    if (!$this->is_new())
      $this->text = file_get_contents($this->filename());
  }
  function save() {
	  if ($this->text == '') {
	    if (!$this->is_new())
	      $this->delete(); // delete empty files
	    return;
    }
    $handle = @fopen($this->filename(), 'w') or die('Error saving page.');
    @fwrite($handle, $this->text) or die('Error saving page.');
    fclose($handle);
  }
  function delete() {
    unlink($this->filename());
  }
}
