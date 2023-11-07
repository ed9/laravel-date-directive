<?php

namespace Ed9\LaravelDateDirective;

use Carbon\Carbon;

/**
 * Class Handler
 * @package Ed9\LaravelDateDirective
 */
class Handler
{
    /**
     * Contains the timezone of the date-time-directive to use.
     *
     * @var string
     */
    private $timezone;

    /**
     * Clarifies if the date-time-directive should show seconds.
     *
     * @var bool
     */
    private $useSeconds;

    /**
     * Defines the date time format of the input when provided as a string.
     *
     * @var string
     */
    private $stringFormat;

    /**
     * Defines if the date-time-directive should show time in 12-hour format.
     *
     * @var bool
     */
    private $use12HourClock;

    public function __construct()
    {
        $this->setTimezone(config('date-time-directive.timezone', config('app.timezone', 'UTC')));
        $this->setUseSeconds(boolval(config('date-time-directive.useSeconds', false)));
        $this->setInputDateTimeFormat(config('date-time-directive.string_format', 'Y-m-d H:i:s'));
        $this->set12HourFormat(config('date-time-directive.use_12_hour_clock', false));
    }

    /**
     * Defines if the date-time-directive should show time in 12-hour format.
     *
     * @param $boolean
     * @return $this
     */
    public function set12HourFormat($boolean): self
    {
        $this->use12HourClock = $boolean;
        return $this;
    }

    /**
     * Define the date time format of the input when provided as a string.
     *
     * @param $input
     * @return $this
     */
    public function setInputDateTimeFormat($input): self
    {
        $this->stringFormat = $input;
        return $this;
    }

    /**
     * Define the timezone of the date-time-directive to use.
     *
     * @param mixed $timezone
     * @return $this
     */
    public function setTimezone($timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Define if the date-time-directive should show seconds.
     *
     * @param $boolean
     * @return $this
     */
    public function setUseSeconds($boolean): self
    {
        $this->useSeconds = $boolean;
        return $this;
    }

    private function handleDateTimeInput($input): ?Carbon
    {
        if (is_string($input)) {
            return Carbon::createFromFormat($this->stringFormat, $input);
        }

        if (!$input instanceof Carbon) {
            return null;
        }

        return $input;
    }

    public function time($input): string
    {
        if (!$input = $this->handleDateTimeInput($input)) {
            return '';
        }

        return ReadableTime($input, $this->use12HourClock, $this->useSeconds, $this->timezone);
    }

    public function date($input): string
    {
        if (!$input = $this->handleDateTimeInput($input)) {
            return '';
        }

        return ReadableDate($input, $this->use12HourClock, $this->useSeconds, $this->timezone);
    }

    public function dateTime($input): string
    {
        if (!$input = $this->handleDateTimeInput($input)) {
            return '';
        }

        return ReadableDateTime($input, $this->use12HourClock, $this->useSeconds, $this->timezone);
    }

}
