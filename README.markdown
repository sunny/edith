Edith
=====

A quick small wiki, perfect for pasting quick texts or code between friends.

Don't worry about saving, it saves every 2 seconds. Paste and forget! Think of it as a magic web notepad. Try it out at [http://edit.sunfox.org/any-page-name](http://edit.sunfox.org/any-page-name).

Setup
-----

- Make a writeable directory that will contain your pages as txt files. For example:

        mkdir mydata
        chmod a+wx mydata

- Copy `config.php.example` to `config.php`, pointing EDITH_DATA to your new directory
- Tell your http server app to redirect 404s to index.php.

    - Under apache copy `.htaccess.example` to `.htaccess` and modify the `RewriteBase` directive.
    - Under lighttpd, add this line to your configuration:

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

