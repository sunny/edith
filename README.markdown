Edith
=====

A quick small wiki, perfect for pasting quick texts or code between friends.

Try it out at [edit.sunfox.org](http://edit.sunfox.org)/anythingyoulike. Paste and forget! Don't worry about saving, it saves every 2 seconds. Think of it as a magic web notepad.

Configuration
-------------

Copy `config.php.example` to `config.php`, editing it as you like.

Make the `data` directory writable, possibly like so `chmod -R a+w data/`.

Unless you're using the `.htaccess` under Apache, rewrite URIs in your HTTP server like this:
`^([^/]*)/?([^/]*)$` -> `index.php?name=$1&representation=$2`


Usage
-----

- `/any-page-name`: type what you want, it's saved automagically!
- `/any-page-name/txt`: raw txt version of your text.
- `/any-page-name/html`: your text in html, pushed through the markdown syntax.


Licence
------

- By Sunny Ripert <sunny@sunfox.org>
- Under the [GPL](http://www.gnu.org/copyleft/gpl.html)
