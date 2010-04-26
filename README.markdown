Edith
=====

A quick small wiki, perfect for pasting quick texts or code between friends.

Don't worry about saving, it saves every 2 seconds. Paste and forget! Think of it as a magic web notepad. Try it out at [http://edit.sunfox.org/any-page-name](http://edit.sunfox.org/any-page-name).

Usage
-----

- `/any-page-name`: type what you want, it's saved automagically!
- `/any-page-name.txt`: raw text version.
- `/any-page-name.html`: html representation, pushed through the markdown syntax.

Setup
-----

- Make a writeable directory that will contain your pages as txt files. For example: `mkdir data && chmod a+w data`
- Tell your http server to redirect 404s to `index.php` (under Apache copy `htaccess.example` to `.htaccess` and modify the `RewriteBase` directive if necessary)
- Copy `config.example.php` to `config.php` and modify it to your liking
- To enable concurrent access, uncomment the lines in `config.php` regarding [Google Mobwrite](http://code.google.com/p/google-mobwrite/)

Licence
------

- By Sunny Ripert <sunny@sunfox.org>
- Under the [GPL](http://www.gnu.org/copyleft/gpl.html)

