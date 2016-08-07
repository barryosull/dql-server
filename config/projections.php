<?php

return [

    'application' => [
        \App\Projection\Database\Projection::class =>
            \Infrastructure\App\Projection\Database\Projection::class,
        
        \App\Projection\Domain\Projection::class =>
            \Infrastructure\App\Projection\Domain\Projection::class,
    ],

    'domain' => [
        \Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse\Projection::class =>
            \Infrastructure\Domain\DQL\Modelling\Aggregate\Database\Projection\NameAlreadyInUse\Projection::class,
        
        \Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse\Projection::class =>
            \Infrastructure\Domain\DQL\Modelling\Aggregate\Domain\Projection\NameAlreadyInUse\Projection::class
    ],
];
