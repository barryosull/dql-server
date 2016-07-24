<?php

return [

    'application' => [
        \App\Projections\Database\Projection::class =>
            \Infrastructure\App\Projections\Database\Projection::class,
    ],

    'domain' => [
        \Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse\Projection::class =>
            \Infrastructure\Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse\Projection::class
    ],
];
