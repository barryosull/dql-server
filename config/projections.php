<?php

return [

    'application' => [
        \App\Projection\ID\Projection::class =>
            \Infrastructure\App\Projection\ID\Projection::class,
    ],

    'domain' => [
        \Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse\Projection::class =>
            \Infrastructure\Domain\Modeling\Schema\Aggregate\Database\Projection\NameAlreadyInUse\Projection::class
    ],
];
