<?php

declare(strict_types=1);

use NunoMaduro\PhpInsights\Domain\Sniffs\ForbiddenNormalClassesSniff;
use NunoMaduro\PhpInsights\Domain\Sniffs\ForbiddenTraitsSniff;
use NunoMaduro\PhpInsights\Domain\Sniffs\ForbiddenSetterSniff;

return [
    /*
    |--------------------------------------------------------------------------
    | Default Preset
    |--------------------------------------------------------------------------
    |
    | This option controls the default preset that will be used by PHP Insights
    | to make your code reliable, simple, and maintainable. Please make sure
    | the preset you select does not conflict with your project's requirements.
    |
    */

    'preset' => 'laravel',

    /*
    |--------------------------------------------------------------------------
    | IDE
    |--------------------------------------------------------------------------
    |
    | This option allows to add hyperlinks in your terminal to quickly open
    | files in your favorite IDE while browsing your PhpInsights report.
    |
    */

    'ide' => 'phpstorm',

    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may adjust all the various settings that are maintained by the
    | package. You can add as many custom rules as you wish.
    |
    */

    'config' => [
        /*
        |--------------------------------------------------------------------------
        | Requirements
        |--------------------------------------------------------------------------
        |
        | The minimum percentage of each requirement that needs to be met for
        | the code to be considered maintainable. If any requirement is not
        | met, the code will be considered unmaintainable.
        |
        */

        'requirements' => [
            'min-quality' => 80.0,
            'min-complexity' => 80.0,
            'min-architecture' => 80.0,
            'min-style' => 80.0,
        ],

        /*
        |--------------------------------------------------------------------------
        | Excluded Files
        |--------------------------------------------------------------------------
        |
        | Here you may exclude files from being analyzed by PHP Insights. You
        | can either exclude specific files or entire directories.
        |
        */

        'exclude' => [
            'vendor',
            'node_modules',
            'storage',
            'bootstrap/cache',
            'tests',
            'database/seeders',
            'database/factories',
            'config',
            'resources/lang',
        ],

        /*
        |--------------------------------------------------------------------------
        | Add Sniffs
        |--------------------------------------------------------------------------
        |
        | Here you can add your own custom sniffs to the analyzer. These sniffs
        | will be added to the default preset that you have selected.
        |
        */

        'add' => [
            ForbiddenNormalClassesSniff::class,
            ForbiddenTraitsSniff::class,
        ],

        /*
        |--------------------------------------------------------------------------
        | Remove Sniffs
        |--------------------------------------------------------------------------
        |
        | Here you can remove sniffs from the analyzer. These sniffs will be
        | removed from the default preset that you have selected.
        |
        */

        'remove' => [
            ForbiddenSetterSniff::class,
        ],
    ],
];
