<?php
/**
 * Edith configuration
 */

// Root URL to your application, with no trailing slash.
# define('EDITH_URI', '/edith');
define('EDITH_URI', '');

// Path to the folder where you want to save the txt files.
// It needs to be readeable and writeable by the server.
# define('EDITH_DATA_PATH', 'data');

// Regular Expression to distinguish between the page and the extension
// For example if you prefer `/page.js/txt` URIs instead of `/page.js.txt`, use the regexp below:
# define('URI_REGEX', '#^/?([^/]+?)(?:/(.+))?/?$#');


/*
 * To handle concurrent access, you can enable Google Mobwrite by using the lines below.
 *  Read more about Google Mobwrite: http://code.google.com/p/google-mobwrite/
 */

// Choose a unique identifier for your application so that Mobwrite can identify all your pages.
# define('MOBWRITE_KEY', 'edith');

// Mobwrite URL
# define('MOBWRITE_URI', 'http://edith-mobwrite.appspot.com');

