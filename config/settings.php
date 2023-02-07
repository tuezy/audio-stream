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
            'value' => 'Truyền Thanh Số Hóa',
            'type' => 'text',
        ],
        'hotline' => [
            'title' => 'admin.settings.general.hotline',
            'key'   => 'hotline',
            'value' => '0933-48-99-66',
            'type' => 'text',
        ],
        'address' => [
            'title' => 'admin.settings.general.address',
            'key'   => 'address',
            'value' => '139 Đinh Tiên Hoàng, Phường Đa Kao, Quận 1, Hồ Chí Minh',
            'type' => 'text',
        ],
        'email' => [
            'title' => 'admin.settings.general.email',
            'key'   => 'email',
            'value' => 'sales.htl@hoangthelong.vn',
            'type' => 'text',
        ],
    ]
];
