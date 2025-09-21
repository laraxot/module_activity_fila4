<?php

<<<<<<< HEAD
declare(strict_types=1);


=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
declare(strict_types=1);


=======
>>>>>>> a12f125f4a (.)
=======
declare(strict_types=1);


>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
return [
    'fields' => [
        'id' => [
            'label' => 'ID',
            'tooltip' => 'Unique identifier of the snapshot',
        ],
        'aggregate_uuid' => [
            'label' => 'Aggregate UUID',
            'tooltip' => 'Unique identifier of the aggregate',
        ],
        'aggregate_version' => [
            'label' => 'Aggregate Version',
            'tooltip' => 'Version number of the aggregate',
        ],
        'state' => [
            'label' => 'State',
            'tooltip' => 'Current state of the snapshot',
        ],
        'created_at' => [
            'label' => 'Created At',
            'tooltip' => 'Date and time when the snapshot was created',
        ],
    ],
    'actions' => [
        'view' => [
            'label' => 'View',
            'tooltip' => 'View snapshot details',
        ],
        'delete' => [
            'label' => 'Delete',
            'tooltip' => 'Delete this snapshot',
            'confirmation' => 'Are you sure you want to delete this snapshot?',
        ],
    ],
    'filters' => [
        'date' => [
            'label' => 'Date',
            'tooltip' => 'Filter by creation date',
        ],
        'state' => [
            'label' => 'State',
            'tooltip' => 'Filter by state',
        ],
    ],
];
