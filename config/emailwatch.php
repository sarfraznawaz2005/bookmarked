<?php

return [
    // enable or disable package
    'enabled' => env('EMAILWATCH_ENABLE', true),

    // Path where eml files will be saved
    'path' => storage_path('eml'),

    // Time in seconds to keep old eml files
    'keep_time' => 300
];
