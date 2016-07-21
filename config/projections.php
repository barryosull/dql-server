<?php

return [

    'application' => [
        \App\Projections\Environment\Projection::class =>
            \Infrastructure\App\Projections\Environment\Projection::class,
    ],

    'domain' => [
        \Domain\DDD\Schema\Aggregate\Environment\Projection\NameAlreadyInUse\Projection::class =>
            \Infrastructure\Domain\DDD\Schema\Aggregate\Environment\Projection\NameAlreadyInUse\Projection::class
    ],
];
