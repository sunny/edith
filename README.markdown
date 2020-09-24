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

Clone it locally:

```sh
$ git clone https://github.com/sunny/edith.git
$ cd edith
```

### Using Docker

Build the image:

```sh
$ docker build . -t edith
```

Run it:

```sh
$ docker run --rm -p 8888:80 edith
```

Now you can access Edith from http://localhost:8888/

### Using a local web server

Make the `data` directory writeable:

```sh
$ chmod a+w data
```

Run it with a web server that interprents PHP and points all 404s
to `index.php`:

- PHP's built-in server for development:

  ```sh
  $ php -S localhost:8888 index.php
  ```

- Apache:

  You can use the example htaccess.

  ```sh
  $ cp htaccess.example .htaccess
  ```

- nginx:

  Add the following directive to your nginx configuration:

  ```
  try_files $uri $uri/ @rewrites;
  location @rewrites {
    rewrite ^ /index.php last;
  }
  ```

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

To deactivate the creation of new pages, make the `data` directory itself
non-writeable.

#### URLs

You may use any file name you like as long as it doesn't end like a
representation (`.txt` or `.html`).

If you prefer `/page.js/txt` URLs instead of `/page.js.txt`, the config file
has a setting for you.

Contributing
------------

You are welcome to contribute by adding issues and
[forking the code on GitHub](https://github.com/sunny/edith).

Licence
-------

Edith is released under the
[MIT License](https://opensource.org/licenses/MIT).
