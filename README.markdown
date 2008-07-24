Edith
=====

A quick small wiki, perfect for pasting quick texts or code.
Saves every 2 seconds. Think of it of a web notepad.

Usage
-----

- /your-page-name      : type what you want, it's saved automagically!
- /your-page-name.txt  : raw txt version of your text.
- /your-page-name.html : your text in html, pushed through the markdown syntax.

Configuration
-------------

    $ chmod +w data/

Copy `config.php.example` to `config.php`, modifying its options in it if necessary.

Then, you'll need some way to rewrite URIs like this: `^([^/]*)$` -> `index.php?name=$1`
(or use the `.htaccess` file to your liking).

Licence
------

- By Sunny Ripert <sunny@sunfox.org>
- Under the GPL http://www.gnu.org/copyleft/gpl.html
