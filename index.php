<?php
/*
 * Edith's dispatching controller.
 *
 * RESTfully answers to GET, HEAD, POST, PUT and DELETE to these resources:
 *   /{pagename}
 *   /{pagename}.{representation}
 */

@include 'config.php';
require 'lib/helpers.php';
require 'lib/page.class.php';

require_once 'lib/Michelf/MarkdownExtra.inc.php';

define('EDITH_REPRESENTATIONS', array('html', 'txt', 'remark', 'graphviz'));

if (!defined('EDITH_URI'))
  define('EDITH_URI', '');

if (!defined('EDITH_DATA_PATH'))
  define('EDITH_DATA_PATH', 'data');

if (!defined('EDITH_DATA_EXTENSION'))
  define('EDITH_DATA_EXTENSION', '.txt');

if (!defined('EDITH_UNWRITEABLE_PAGES'))
  define('EDITH_UNWRITEABLE_PAGES', array());

if (!defined('URI_REGEX'))
  define(
    'URI_REGEX',
    '#^/?([^/]+?)\.?('.implode('|', EDITH_REPRESENTATIONS).')?$#'
  );

if (!defined('MOBWRITE_KEY'))
  define('MOBWRITE_KEY', 'edith');

if (!defined('MOBWRITE_URI'))
  define('MOBWRITE_URI', null);

if (file_exists(preg_replace('#^\/#', '', $_SERVER["REQUEST_URI"])))
  return false;

require 'lib/routes.php';
