<?php

class Page {
  public $name;
  public $text;

  function __construct($name = '') {
    $this->name = $name ? $name : 'index';
    $this->text = '';
  }

  function filepath() {
    $path = dirname(__FILE__) . '/../' . EDITH_DATA_PATH;
    $name = str_replace('.', '_', $this->name) . EDITH_DATA_EXTENSION;
    return $path . '/' . $name;
  }

  function name() {
    $name = str_replace('_', ' ', $this->name);
    $name = str_replace('-', ' ', $name);
    $name = ucwords($name);
    return $name;
  }

  function has_safe_name() {
    return preg_match("/^[a-z0-9-._%]+$/i", $this->name);
  }

  function exists() {
    return is_file($this->filepath());
  }

  function load() {
    $this->text = 'Edit me!';
    if ($this->exists()) {
      $this->text = file_get_contents($this->filepath());
    }
  }

  function save() {
    if ($this->text == '') {
      if ($this->exists()) {
        $this->delete(); // delete empty files
      }
      return;
    }

    $handle = @fopen($this->filepath(), 'w');
    if (!$handle) {
      throw new Exception('Error opening the file in write mode');
    }

    $this->text = str_replace("\r\n", "\n", $this->text); // CRLF to LF

    $ok = @fwrite($handle, $this->text);
    if (!$ok) return false;
    fclose($handle);
    return true;
  }

  function delete() {
    return unlink($this->filepath());
  }

  function is_writable() {
    if ($this->exists()) {
      if (!is_writable($this->filepath())) return false;

      return !in_array($this->name, EDITH_UNWRITEABLE_PAGES);
    } else {
      return is_writable(dirname($this->filepath()));
    }
  }
}
