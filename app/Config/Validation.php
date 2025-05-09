<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $login = [
        'user'  => 'required',
        'password'   => 'required',
    ];

    public $login_errors = [
        'user' => [
            'required' => 'El campo "Usuario" es obligatorio',
        ],
        'password' => [
            'required' => 'El campo "Contraseña" es obligatorio',
        ]
    ];

    public $insertNewMember = [
        'nombre'  => 'required',
        'cedula'  => 'required',
        'user'  => 'required',
        'password'   => 'required',
        'idciudad'  => 'greater_than[0]',
    ];

    public $insertNewMember_errors = [
        'nombre' => [
            'required' => 'El campo "Nombre" es obligatorio',
        ],
        'user' => [
            'required' => 'El campo "Usuario" es obligatorio',
        ],
        'cedula' => [
            'required' => 'El campo "Documento" es obligatorio',
        ],
        'password' => [
            'required' => 'El campo "Contraseña" es obligatorio',
        ],
        'idciudad' => [
            'greater_than' => 'El campo "Ciudad" es obligatorio',
        ]
    ];

    public $insertPedido = [
        'nombre'  => 'required',
        'codigo_socio'  => 'required',
        'idpaquete'  => 'greater_than[0]',
        'cantidad'   => 'required',
        'total'  => 'required',
    ];

    public $insertPedido_errors = [
        'nombre' => [
            'required' => 'El campo "Nombre" es obligatorio',
        ],
        'codigo_socio' => [
            'required' => 'El campo "Código Socio" es obligatorio',
        ],
        'idpaquete' => [
            'required' => 'El campo "Paquete" es obligatorio',
        ],
        'cantidad' => [
            'required' => 'El campo "Cantidad" es obligatorio',
        ],
        'total' => [
            'required' => 'El campo "Total" es obligatorio y no puede ser cero',
        ]
    ];
}
