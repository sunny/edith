Edith
=====

A quick small wiki, perfect for pasting quick texts or code between friends.

Don't worry about saving, it saves every 2 seconds. Paste and forget! Think of it as a magic web notepad.

Try it out at [http://edit.sunfox.org/any-page-name](http://edit.sunfox.org/any-page-name).


Usage
-----

- `/any-page-name`: type what you want, it's saved automagically!
- `/any-page-name.txt`: raw text version.
- `/any-page-name.html`: HTML version through the [Markdown](http://daringfireball.net/projects/markdown/) syntax.

Keyboard shortcut `cltr-e` switches from edit mode to HTML mode.


### Concurrent Access

To enable multiple browsers to see live changes at the same time and hopefully not overwrite each other's stuff Edith uses [Google Mobwrite](http://code.google.com/p/google-mobwrite/).

### REST

Edith is also a RESTful API. So go ahead and try to `PUT` or `DELETE` on these URLs.


Install it yourself
-------------------

First, if you don't have it already, install Coffeescript to compile the JavaScript. Install [npm](http://nodejs.org/download/), then:

```sh
$ npm install -g coffeescript
```

Get the files.

```sh
$ git clone https://github.com/sunny/edith.git
$ cd edith
```

Make the `data` directory writeable.

```sh
$ chmod a+w data
```

Tell your HTTP server to redirect pages not found to `index.php`. If you are using Apache:

```sh
$ cp htaccess.example .htaccess
```

Compile the JavaScript.

```sh
$ cake build
```


### Further use

This section is only for ninjas and such.

#### Configuration

Copy `config.example.php` to `config.php` and read the examples to use your own configuration file.

#### Concurrent Access

You can activate Google Mobwrite and define your own endpoint in `config.php`.

#### Read-only pages

To make pages read-only, just make them non-writeable on disk:

```sh
$ chmod -w data/foo.txt
```

They will then be shown using the HTML representation through Markdown instead.

Also, if you make the `data` directory itself non-writeable you can deactivate the creation of new pages.

#### URLs

You may use any file name you like as long as it doesn't end like a representation (`.txt` or `.html`).

If you prefer `/page.js/txt` URLs instead of `/page.js.txt`, the config file has a setting for you.

#### Rack

If you would prefer to serve the app using Rack, a `config.ru` is created to use the `rack-legacy` and `rack-rewrite` gems.


Contributing
------------

You are welcome to contribute by adding issues and [forking the code on Github](https://github.com/sunny/edith).


Licence
-------

Edith is released under the [MIT License](http://www.opensource.org/licenses/MIT).
