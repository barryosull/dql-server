<?php

return [

    'application' => [
        'projectors' => [
            '16fa1308-d1c8-4b92-b2a9-b39046be1af6' =>
                App\Projection\ID\Projector::class,
            '94bc23d3-6b4a-4156-855a-121837f2480a' =>
                App\Projection\Domain\Projector::class
        ],
        'workflows' => [

        ],
    ],

    'domain' => [
        'projectors' => [
            '121837f2-6b4a-4450-855a-94bc23d2db49' => 
                Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse\Projector::class,
            'bc34e480-779d-4156-92c7-631003a898e6' => 
                Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse\Projector::class
        ],
        'workflows' => [

        ],
    ]
];
