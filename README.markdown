Edith
=====

A quick small wiki, perfect for pasting quick texts or code.
Saves every 2 seconds. Think of it as a magic web notepad.

Usage
-----

- `/any-page-name`: type what you want, it's saved automagically!
- `/any-page-name.txt`: raw txt version of your text.
- `/any-page-name.html`: your text in html, pushed through the markdown syntax.

Configuration
-------------

Copy `config.php.example` to `config.php`, modifying its options in it if necessary.

Then, rewrite URIs like this: `^([^/]*)$` -> `index.php?name=$1`
or use the `.htaccess` file if you are using Apache.

Finally, make the `data` directory writable, perhaps like so: `chmod 777 data/`.


Licence
------

- By Sunny Ripert <sunny@sunfox.org>
- Under the GPL http://www.gnu.org/copyleft/gpl.html
