# Laravel Date Directive

## Overview:

Laravel Date Directive is a comprehensive Laravel library designed to address persistent challenges related to site content, user interactions, and regional settings. It facilitates the seamless presentation of date and time elements based on user
timezones. This library extends on-top of the [laravel-readable](https://github.com/Pharaonic/laravel-readable) library.

## Installation:

To integrate the library into your Laravel project, use Composer:

```bash
composer require ed9/laravel-date-directive
```

## Configuration:

To customize the library behavior, publish the configuration file:

```bash
php artisan vendor:publish --tag=date-time-directive
```

### Configuration options include:

| Key                 | 	Type   | 	Description                                                                                                             |
|---------------------|---------|--------------------------------------------------------------------------------------------------------------------------|
| always_show_seconds | boolean | When the library outputs time, it includes seconds if set to true.                                                       |
| timezone            | string	 | A valid timezone name; refer to the list of [supported timezones](https://www.php.net/manual/en/timezones.php).          |
| string_format       | string  | Supports \Carbon\Carbon or string input; if string is used, it must match the configured format.                         |
| use_12_hour_clock   | boolean | When the library outputs time, it displays the time in 12-hour format if set to true, or 24-hour format if set to false. |

## Setup:

Configure the system default settings in the configuration file.
Optionally, configure per-user settings by adding timezone and other configuration items to your users table.
Update the \App\Http\Middleware\Authenticate::class by extending the boot method, overriding the library configuration during runtime.

```php
public function handle($request, Closure $next, ...$guards)
{
    if ($user = auth()->user()) {
        $handler = app(\Ed9\LaravelDateDirective\Handler::class);
        $handler->set12HourFormat($user->show_time_with_12_hours);
        $handler->setTimezone($user->timezone);
    }

    return parent::handle($request, $next, ...$guards);
}
```

## Usage:

### In Blade Templates:

| Directive | 	Arguments             | 	Output                                                            |
|-----------|------------------------|--------------------------------------------------------------------|
| @time     | \Carbon\Carbon, string | Outputs the time of the input in the configured timezone.          |
| @date     | \Carbon\Carbon, string | Outputs the date of the input in the configured timezone.          |
| @dateTime | \Carbon\Carbon, string | Outputs the date and time of the input in the configured timezone. |

#### Example:

```blade
User {{ $user->name}} was created at @time($user->created_at) on @date($user->created_at).
Some might say, this was on @dateTime($user->created_at)!
```

### In PHP Code:

If you need access to the formatted and converted values in your PHP code, use the \Ed9\LaravelDateDirective\Handler:

```php
$handler = app(\Ed9\LaravelDateDirective\Handler::class);
echo 'User ' . $user->name . ' was created at ' . $handler->time($user->created_at).' on '.$handler->date($user->created_at) . '.';
echo 'Some might say, this was on ' . $handler->dateTime($user->created_at) . '!';
```

## Available Methods via Handler:

* `set12HourFormat(boolean): self`: Configures the library to return time in 12 or 24-hour format.
* `setInputDateTimeFormat(string): self`: Configures the expected input format when calling directives using string values.
* `setTimezone(string): self`: Configures the timezone to which all output should be converted.
* `setUseSeconds(boolean): self`: Configures the library to return time with or without seconds.
* `time(\Carbon\Carbon|string): string`: Converts provided input into a time string in the configured timezone.
* `date(\Carbon\Carbon|string): string`: Converts provided input into a date string in the configured timezone.
* `dateTime(\Carbon\Carbon|string): string`: Converts provided input into a datetime string in the configured timezone.
