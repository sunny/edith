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

- Make `data` a writeable directory. For example: `$ chmod a+w data`
- Tell your HTTP server to redirect 404s to `index.php`. If using Apache, simply copy `htaccess.example` to `.htaccess`


Further use
-----------

This section is only for ninjas and such.

### Configuration

Copy `config.example.php` to `config.php` and read the examples to use your own configuration file.

### Concurrent Access

To enable multiple browsers to see live changes at the same time and hopefully not overwrite each other's stuff Edith uses [Google Mobwrite](http://code.google.com/p/google-mobwrite/) which you can activate in `config.php`.

### Read-only pages

To make pages read-only, just make them non-writeable on disk:

```sh
$ chmod -w data/foo.txt
```

They will then be shown using the html representation through Markdown instead.

Also, if you make the `data` directory itself non-writeable you can deactivate the creation of new pages.

### URLs

You may use any file name you like as long as it doesn't end like a representation (`.txt` or `.html`).

If you prefer `/page.js/txt` URLs instead of `/page.js.txt`, the config file has a setting for you.

### Rack

If you would like to serve the app using Rack, a `config.ru` is created to use the `rack-legacy` and `rack-rewrite` gems.


Licence
-------

- Author: Sunny Ripert <sunny@sunfox.org>
- Licence: [GPL](http://www.gnu.org/copyleft/gpl.html)
- Code on github: [https://github.com/sunny/edith](sunny/edith/)


