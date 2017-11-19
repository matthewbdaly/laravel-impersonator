# laravel-impersonator

[![Build Status](https://travis-ci.org/matthewbdaly/laravel-impersonator.svg?branch=master)](https://travis-ci.org/matthewbdaly/laravel-impersonator)
[![Coverage Status](https://coveralls.io/repos/github/matthewbdaly/laravel-impersonator/badge.svg?branch=master)](https://coveralls.io/github/matthewbdaly/laravel-impersonator?branch=master)

Impersonate other users to assist in resolving issues

Installation
------------

Run the following command to install the package:

```bash
composer require matthewbdaly/laravel-impersonator
```

Then just include this in your `app/Http/Kernel.php` in the appropriate place where you want to import the middleware:

```php
\Matthewbdaly\LaravelImpersonator\Http\Middleware\Impersonator::class
```

You can apply it globally, or only to specific routes as you wish. You will also need to add the trait `Matthewbdaly\LaravelImpersonator\Eloquent\Traits\CanImpersonate` to your user model to add these methods:

* `startImpersonating($id)` - start impersonating user `$id`
* `stopImpersonating()` - stop impersonating
* `isImpersonating()` - Is user impersonating or not?
