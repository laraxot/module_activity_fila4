<?php

<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b93ef594b4 (.)
>>>>>>> b1cd7fc (.)
declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'Modifica Attività',
        'plural' => 'Modifica Attività',
        'group' => [
            'name' => 'Monitoraggio',
            'description' => 'Modifica delle attività di sistema',
        ],
        'label' => 'Modifica Attività',
        'sort' => 65,
        'icon' => 'activity-edit-animated',
    ],
    'form' => [
        'title' => 'Modifica Attività',
        'description' => 'Modifica i dettagli dell\'attività',
        'save' => 'Salva Modifiche',
        'cancel' => 'Annulla',
    ],
    'fields' => [
        'description' => [
            'label' => 'Descrizione',
            'placeholder' => 'Inserisci descrizione',
            'help' => 'Descrizione dettagliata dell\'attività',
        ],
        'properties' => [
            'label' => 'Proprietà',
            'placeholder' => 'Inserisci proprietà',
            'help' => 'Proprietà aggiuntive in formato JSON',
        ],
        'metadata' => [
            'label' => 'Metadata',
            'placeholder' => 'Inserisci metadata',
            'help' => 'Informazioni metadata aggiuntive',
        ],
    ],
    'messages' => [
        'success' => 'Attività modificata con successo',
        'error' => 'Errore durante la modifica dell\'attività',
        'validation_error' => 'Errore di validazione: controlla i campi inseriti',
    ],
    'validation' => [
        'description.required' => 'La descrizione è obbligatoria',
        'description.max' => 'La descrizione non può superare :max caratteri',
        'properties.json' => 'Le proprietà devono essere un JSON valido',
    ],
];
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
>>>>>>> origin/develop
return array (
  'actions' => 
  array (
    'delete' => 
    array (
      'label' => 'delete',
    ),
    'save' => 
    array (
      'label' => 'save',
    ),
    'cancel' => 
    array (
      'label' => 'cancel',
    ),
  ),
);
<<<<<<< HEAD
>>>>>>> a12f125f4a (.)
=======
>>>>>>> b93ef594b4 (.)
=======
>>>>>>> origin/develop
>>>>>>> b1cd7fc (.)
