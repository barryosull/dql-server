<?php

return [

    'application' => [
        \App\Projection\ID\Projection::class =>
            \Infrastructure\App\Projection\ID\Projection::class,
    ],

    'domain' => [
        \Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse\Projection::class =>
            \Infrastructure\Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse\Projection::class,
        
        \Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse\Projection::class =>
            \Infrastructure\Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse\Projection::class
    ],
];
