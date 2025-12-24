<?php

return [

    'engine' => \Awssat\Visits\DataEngines\EloquentEngine::class,
    'connection' => 'mysql',

    'periods' => [
        'day',
        'week',
        'month',
        'year',
    ],

    'keys_prefix' => 'visits',

    'remember_ip' => 15 * 60,

    'always_fresh' => false,

    'ignore_crawlers' => true,

    'global_ignore' => [],

];
