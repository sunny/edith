Edith
=====

A quick small wiki, perfect for pasting quick texts or code.
Saves every 2 seconds. Think of it of a web notepad.

Usage
-----

- /your-page-name      : type what you want, it's saved automagically!
- /your-page-name.txt  : raw txt version of your text.
- /your-page-name.html : if your text is in markdown syntax this will transform it into pretty html.

Configuration
-------------

You'll need some flavour of PHP and some way to rewrite URIs like this:
    ^([^/]*)$   ->  index.php?name=$1

Licence
------

- By Sunny Ripert <sunny@sunfox.org>
- Under the GPL http://www.gnu.org/copyleft/gpl.html
