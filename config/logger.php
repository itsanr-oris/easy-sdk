<?php

return [
    /**
     * default log channel
     */
    'default' => 'daily',

    /**
     * available log channels
     */
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single', 'daily'],
        ],

        'single' => [
            'driver' => 'single',
            'path' => __DIR__ . '/../logs/easy-logger.log',
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => __DIR__ . '/../logs/easy-logger.log',
            'level' => 'info',
        ],
    ],
];
