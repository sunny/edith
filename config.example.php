<?php
/**
 * Edith configuration
 */

// Root URL to your application, with no trailing slash.
# define('EDITH_URI', '/edith');
define('EDITH_URI', '');

// Path to the folder where you want to save the txt files.
// It needs to be readable and writable by the server.
# define('EDITH_DATA_PATH', 'data');

// Regular Expression to distinguish between the page and the extension
// For example if you prefer `/page.js/txt` URIs instead of `/page.js.txt`, use the regexp below:
# define('URI_REGEX', '#^/?([^/]+?)(?:/(.+))?/?$#');


// Extension of files living in the data directory
# define('EDITH_DATA_EXTENSION', '.txt');
