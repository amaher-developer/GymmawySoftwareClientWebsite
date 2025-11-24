<?php
return [

'default' => 'main',

'mapping' => [
    'main' => [
        'domains' => ['localhost', '127.0.0.1'],
        'env' => 'local',
    ],
    // Gym domains - these should have corresponding .env files in /envs folder
    '60minutes' => [
        'domains' => ['60mingym.sa'],
        'env' => '60minutes',
    ],

    'almada' => [
        'domains' => ['almada.gymmawy.com'],
        'env' => 'almada',
    ],


    'kythara' => [
        'domains' => ['thecakorinas.com'],
        'env' => 'kythara',
    ],

    'redbone' => [
        'domains' => ['redbonegym.com'],
        'env' => 'redbone',
    ],


    'step' => [
        'domains' => ['fitnessstepgym.com'],
        'env' => 'step',
    ],

    'sw_gymmawy' => [
        'domains' => ['sw.gymmawy.com'],
        'env' => 'sw_gymmawy',
    ],

    'zahmi' => [
        'domains' => ['zahmi.gymmawy.com'],
        'env' => 'zahmi',
    ],

    'zone' => [
        'domains' => ['zone.gymmawy.com'],
        'env' => 'zone',
    ],

    'redbone' => [
        'domains' => ['redbone.localhost'],
        'env' => 'redbone',
    ],

    'step' => [
        'domains' => ['step.localhost'],
        'env' => 'step',
    ],
],

];
