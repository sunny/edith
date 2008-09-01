Edith
=====

A quick small wiki, perfect for pasting quick texts or code.
Saves every 2 seconds. Think of it as a magic web notepad.

Configuration
-------------

Copy `config.php.example` to `config.php`, modifying its options in it if necessary.
Make the `data` directory writable, perhaps like so `chmod -R a+w data/`.

Unless you're using the `.htaccess`, rewrite URIs in your HTTP server like this:
`^([^/]*)/?([^/]*)($` -> `index.php?name=$1&representation=$2`


Usage
-----

- `/any-page-name`: type what you want, it's saved automagically!
- `/any-page-name/txt`: raw txt version of your text.
- `/any-page-name/html`: your text in html, pushed through the markdown syntax.


Licence
------

- By Sunny Ripert <sunny@sunfox.org>
- Under the GPL http://www.gnu.org/copyleft/gpl.html
