Edith
=====

A quick small wiki, perfect for pasting quick texts or code between friends.

Don't worry about saving, it saves every 2 seconds. Paste and forget! Think of it as a magic web notepad.

Try it out at [http://edit.sunfox.org/any-page-name](http://edit.sunfox.org/any-page-name).

Usage
-----

- `/any-page-name`: type what you want, it's saved automagically!
- `/any-page-name.txt`: raw text version.
- `/any-page-name.html`: html version through the [Markdown](http://daringfireball.net/projects/markdown/) syntax.

Setup
-----

- Copy `config.example.php` to `config.php`
- Make `data` a writeable directory. For example: `$ chmod a+w data`
- Tell your http server to redirect 404s to `index.php`. If using Apache, simply copy `htaccess.example` to `.htaccess`


Further use
-----------

This section is only for ninjas and such.

### Concurrent Access

To enable multiple browsers to see live changes at the same time and hopefully not overwrite each other's stuff Edith uses [Google Mobwrite](http://code.google.com/p/google-mobwrite/).

Activate it in `config.php`.


### Read-only pages

Make them non-writeable:

```sh
$ chmod -w data/foo.txt
```

### No new pages

Make the data directory non-writeable:

```sh
$ chmod -w data
```

### URLs

You may use any file name you like as long as it doesn't end like a representation (`.txt` or `.html`).

If you prefer `/page.js/txt` URLs instead of `/page.js.txt`, the config file has a setting for you.


### New template

Create new representations by adding PHP files in `templates/` and using their name as an extension.


Licence
-------

- Author: Sunny Ripert <sunny@sunfox.org>
- Licence: [GPL](http://www.gnu.org/copyleft/gpl.html)
- Code on github: [https://github.com/sunny/edith](sunny/edith/)


