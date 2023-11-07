<?php

return [

    /**
     * Whether to always show seconds in the time directive.
     * This can be overwritten within the Handle class.
     */
    'always_show_seconds' => false,

    /**
     * If you want to set the timezone of the time directive,
     * set the default timezone to pass to the handler.
     * If value is left as a NULL, the `app.timezone` setting
     * will be used instead.
     */
    'timezone' => null,

    /**
     * When passing information as a string, not a Carbon object
     * what is the format the string should be in?
     */
    'string_format' => 'Y-m-d H:i:s',

    /**
     * Specify if all time figures sent to output should be
     * formatted as a 12-hour clock.
     */
    'use_12_hour_clock' => false,

];