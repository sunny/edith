Edith
=====

A quick small wiki, perfect for pasting quick texts or code between friends.

Don't worry about saving, it saves every 2 seconds. Paste and forget! Think of it as a magic web notepad. Try it out at [http://edit.sunfox.org/any-page-name](http://edit.sunfox.org/any-page-name).

Usage
-----

- `/any-page-name`: type what you want, it's saved automagically!
- `/any-page-name.txt`: raw text version.
- `/any-page-name.html`: html representation, pushed through the [Markdown](http://daringfireball.net/projects/markdown/) syntax.

Setup
-----

- Make a writeable directory that will contain your pages as txt files. For example: `mkdir data && chmod a+w data`
- Tell your http server to redirect 404s to `index.php` (under Apache copy `htaccess.example` to `.htaccess` and modify the `RewriteBase` directive if necessary)
- Copy `config.example.php` to `config.php` and modify it to your liking
- To enable concurrent access, uncomment the lines in `config.php` regarding [Google Mobwrite](http://code.google.com/p/google-mobwrite/)

Further use
-----------

This section is only for ninjas and such.

- To stop users from editing a page, make it non-writeable on the disk, e.g. `chmod -w data/foo.txt`.
- To stop users from creating new pages, make the data directory non-writeable, e.g. `chmod -w data`.
- To create a new template, add a PHP file in `templates/` then add its name to the `$TEMPLATES` array in `index.php`.
- If you prefer `/page.js/txt` URIs instead of `/page.js.txt`, change the value of `URI_REGEX` in `index.php` to :

        define('URI_REGEX', '#^/?([^/]+?)(?:/(.+))?/?$#');

Licence
------

- By Sunny Ripert <sunny@sunfox.org>
- Under the [GPL](http://www.gnu.org/copyleft/gpl.html)
- Code on [http://github.com/sunny/edith](http://github.com/sunny/edith/)


