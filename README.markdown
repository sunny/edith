Edith
=====

A quick small wiki, perfect for pasting quick texts or code between friends.

Try it out at [http://edit.sunfox.org/any-page-name](http://edit.sunfox.org/any-page-name). Paste and forget! Don't worry about saving, it saves every 2 seconds. Think of it as a magic web notepad.

Setup
-----

- Copy `config.php.example` to `config.php`, editing it as you like.
- Make your `data` directory writable, possibly like so `chmod -R a+w data/`.
- Tell your http server app to redirect 404s to index.php.

  - For example under lighttpd, add this line to your configuration:

      server.error-handler-404 = "/index.php"

Usage
-----

- `/any-page-name`: type what you want, it's saved automagically!
- `/any-page-name/txt`: raw txt version of your text.
- `/any-page-name/html`: your text in html, pushed through the markdown syntax.


Licence
------

- By Sunny Ripert <sunny@sunfox.org>
- Under the [GPL](http://www.gnu.org/copyleft/gpl.html)

