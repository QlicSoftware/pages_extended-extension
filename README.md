# Pages Extended Extension

This extension add some features to the Pages Module:

 * Translatable Slug & URL
 * Page caching

**Caution**: This extension is a WIP, many things are not finished and others could change w/o notice.


## Install

Using composer `composer required newebtime/pages_extended-extension`.

### On a existing website

Install the extension `php artisan addon:install newebtime.extension.pages_extended`.

Then connect to the `admin` and change the `Page/Type` Handler you are using to `Pages Extended`.

## Uninstall

First connect to the `admin` and change back the `Page/Type` Handler you are using to `Default`.

Then `php artisan addon:uninstall newebtime.extension.pages_extended`.

Don't forgot to also remove the line the your `composer.json`.


## Translatable Slug / URL

By default the Pages slug (and URL) is unique for a single page. For SEO propose, the slug / URL is now translatable
and can be change depending of the locale.

> e.g. You can create a contact Page with `/en/contact` URL for English and for `/de/kontakt` for German


## Cache

Each page can be cached using 3 cache type:

 * Static: create a static HTML page
 * Full: cache the full HTML response
 * Partial: cache the page HTML response

### Static

It will create a complete static HTML page using [PageCache](https://github.com/JosephSilber/page-cache)

Pros
 * Fastest, it is a static page

Cons
 * It's a staic page, you are not in Laravel anymore, so no middleware, no TTL, etc.
 * Server modification is needed.

PS: It's half working when using `php artisan serve`, the page is created but not served, you will need to do a quick
change on `server.php` to make it works. Find the line:

```php
require_once __DIR__.'/public/index.php';
```

and replace it by

```php
if (file_exists(__DIR__.'/public/page-cache'.$uri.'.html')) {
    require_once __DIR__.'/public/page-cache'.$uri.'.html';
} else {
    require_once __DIR__.'/public/index.php';
}
```

### Full

It will cache the complete Response using [ResponseCache](https://github.com/spatie/laravel-responsecache)

Pros
 * Fast, the full response is cached

Cons
 * Dynamic area will be cached until the TTL expire

### Partial

Not implemented yet, it should cache only the Page response.
