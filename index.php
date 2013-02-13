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
require 'lib/markdown.php';

if (!defined('EDITH_URI'))
  define('EDITH_URI', '');

if (!defined('EDITH_DATA_PATH'))
  define('EDITH_DATA_PATH', 'data');

if (!defined('URI_REGEX'))
  define('URI_REGEX', '#^/?([^/]+?)\.?('.implode('|', representations()).')?$#');

if (!defined('APP_CODE'))
  define('APP_CODE', 'edith');

if (!defined('MOBWRITE_URI'))
  define('MOBWRITE_URI', null);

require 'lib/routes.php';
