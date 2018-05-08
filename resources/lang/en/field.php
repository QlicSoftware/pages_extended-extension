<?php

return [
    'cache_type' => [
        'name'         => 'Type',
        'instructions' => 'Specify the type of cache for this page.',
        'option'       => [
            'none'    => 'None',
            'partial' => 'Partial',
            'full'    => 'Full',
            'static'  => 'Static',
        ]
    ],
    'ttl'        => [
        'name'         => 'TTL',
        'instructions' => 'Specify the cache lifetime for this page (in minutes).',
    ],
];
