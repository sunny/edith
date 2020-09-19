Edith
=====

A quick small wiki, perfect for pasting quick texts or code and sharing it between friends.

Don't worry about saving, it saves at every key stroke. Think of it as a magic zero-UI Web notepad.

Try it out at [https://edit.sunfox.org/any-page-name](https://edit.sunfox.org/any-page-name).

Usage
-----

- `/any-page-name`: type what you want, it's saved automagically!
- `/any-page-name.txt`: raw text version.
- `/any-page-name.html`: HTML version through the
  [Markdown](https://daringfireball.net/projects/markdown/) syntax.
- `/any-page-name.remark`: Slideshow version using
  [Remark](https://github.com/gnab/remark).
- `/any-page-name.graphviz`: Graph version of the dot syntax using
  [Viz](https://github.com/mdaines/viz.js/), see
  [WebGraphViz](http://www.webgraphviz.com/) for examples.

Keyboard shortcut `cltr-e` switches from edit mode to HTML mode.

### Favicon

![Magic Favicon changing as the page updates](https://sunny.github.io/edith/favicon.gif)

The favicon changes as the page updates and is also an indicator that the page
is currently saving or not.

### REST

Edith is also a RESTful API. So go ahead and try to `PUT` or `DELETE` on these
URLs.

Install it yourself
-------------------

Manual way:

Download the files. For example, using git:

```sh
$ git clone https://github.com/sunny/edith.git
$ cd edith
```

Make the `data` directory writeable:

```sh
$ chmod a+w data
```

Tell your HTTP server to redirect pages not found to `index.php`.
If you are using Apache:

```sh
$ cp htaccess.example .htaccess
```

Finally, you will need [Node](https://nodejs.org/) to build the JavaScript.
Install CoffeeScript and UglifyJS:

```sh
$ npm install -g coffee-script uglify-js
```

You can now compile, compress and generate JavaScript source maps:

```sh
$ cake build
```

Docker way:

Build the image:

```sh
$ docker build . -t edith
```

Run it!

```sh
$ docker run --rm -p 8888:80 edith
```

Now you can access Edith from http://localhost:8888/

### Further use

This section is only for ninjas and such.

#### Configuration

Copy `config.example.php` to `config.php` and read the examples to use your own
configuration file.

#### Concurrent Access

Multiple users can see live changes at the same time and not overwrite each
other's text. For that you must first install
[Google Mobwrite](https://code.google.com/archive/p/google-mobwrite/) on a
server and define your endpoint in `config.php`.

#### Read-only pages

To make pages read-only, just make them non-writeable on disk:

```sh
$ chmod -w data/foo.txt
```

They will then be shown using the HTML representation through Markdown instead.
This is what is used on [edit.sunfox.org](https://edit.sunfox.org/)'s homepage.

To deactivate the creation of new pages, simply make the  `data` directory
itself non-writeable.

#### URLs

You may use any file name you like as long as it doesn't end like a
representation (`.txt` or `.html`).

If you prefer `/page.js/txt` URLs instead of `/page.js.txt`, the config file
has a setting for you.

#### Development

You can use PHP's built-in server in development:

```sh
$ php -S localhost:3000 index.php
```

Or if you would prefer to serve the app using Rack, a `config.ru` is created,
using the `rack-legacy` and `rack-rewrite` gems.

Contributing
------------

You are welcome to contribute by adding issues and
[forking the code on Github](https://github.com/sunny/edith).

Licence
-------

Edith is released under the
[MIT License](https://opensource.org/licenses/MIT).
