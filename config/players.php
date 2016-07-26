<?php

return [

    'application' => [
        'projectors' => [
           '16fa1308-d1c8-4b92-b2a9-b39046be1af6' =>
                App\Projection\ID\Projector::class
        ],
        'workflows' => [

        ],
    ],

    'domain' => [
        'projectors' => [
            '121837f2-6b4a-4450-855a-94bc23d2db49' => 
                Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse\Projector::class
        ],
        'workflows' => [

        ],
    ]
];
