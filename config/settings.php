<?php
return [
    'dev' => [
        'enable_cache' => [
            'title' => 'admin.settings.dev.enable_cache_title',
            'key'   => 'enable_cache',
            'value' => false,
            'type' => 'boolean',
        ],
        'cache_time' => [
            'title' => 'admin.settings.dev.cache_time_title',
            'key'   => 'cache_time',
            'value' => 10,
            'type' => 'integer',
        ]
    ],
    'general' => [
        'site_title' => [
            'title' => 'admin.settings.general.site_title',
            'key'   => 'site_title',
            'value' => 'Laravel',
            'type' => 'text',
        ],
    ]
];
