# laravel-date-directive
Simplify the date &amp; time handling when in need to show date &amp; time to customer in their timezone.

# Install
Just run
```bash
composer require ed9/laravel-date-directive
```

# Use it in Blade views
When using Blade, pass your `Carbon` date objects to string versions of the format you configured within the package configuration to Blade directives in order to receive beautifully crafted date, time, and date-time output. 

```php
User was creataed at @time($user->created_at), this was on @date($user->created_at).
Some might say, it was on @datetime($user->created_at)...
```

# Best part
By configuring the package via the `config/date-time-directive.php` you may change the input date formatting of your string cases, the conversion timezone, and if you wish to receive as 12 or 24 hour time versions.

If you require a dynamic change, you can access the handle and execute changes on demand. The handler is initiated and contained in a singleton, so any change you make, will retain for future calls.

```php
$handler = app(\Ed9\LaravelDateDirective\Handler::class);
$handler->set12HourFormat(true);
$handler->setInputDateTimeFormat('d/m/Y H:i:s');
$handler->setTimezone('Europe/London');
```

It is assumed that you will always provide this with a UTC time based value, so if you do not have a UTC based time object or a string, convert it to UTC prior calling the handler.

The handler will convert all of your inputs to configured timezone. Say, one of your users has `Europe/London`, whilst another has `Europe/Riga`, and so on - within the initiation of your app, just tell the package handler to configure the timezone for the one that is registered on your user, then - the future output of the date, time and date-time values in the user interface, within this one runtime, will always be in the timezone that you configured.

# Extra

If you want to publish the configuration, do so by executing:

```bash
php artisan vendor:publish --tag=date-time-directive
```
