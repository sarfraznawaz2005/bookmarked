<?php

return [

    // enable or disable plogs.
    'enabled' => env('ENABLE_PLOGS', true),

    // route where visitlog will be available in your app.
    'route' => 'plogs',

    // number of entries to show per page
    'entries_per_page' => 10,

    // set what levels of logs should be captured. It can be one or more of:
    // "debug", "info", "notice", "warning", "error", "critical",
    // "alert", "emergency", "processed". To capture all events just use "all"
    'levels' => [
        'all',
    ],

    // if "true", extra info such as IP, URL, Referer and User will be added to each log if available.
    'extra_info' => true,

    // if "true", request data will also be logged
    'request_info' => true,
    'request_info_except' => ['password', 'confirm_password', 'password_confirmation', 'api_token', '_token'],

    // if "true", session info will also be logged
    'session_info' => false,

    // if "true", headers will also be logged
    'header_info' => false,

    // if "true", laravel.lgo file will be cleaned up automatically
    'clean_log' => true,

    // if "true", the PLogs page can be viewed by any user who provides
    // correct login information (eg all app users).
    'http_authentication' => false,

    // records beyond this number of days will be deleted when viewed.
    'delete_old_days' => 30
];
