<?php

return [

    // All the sections for the settings page
    'sections' => [
        'app' => [
            'title' => 'Configuración general',
            'descriptions' => 'Configuración general.', // (optional)
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'app_name', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Nombre de la app', // label for input
                    // optional properties
                    'placeholder' => 'Nombre de la app', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:2|max:20', // validation rules for this input
                    'value' => 'QCode', // any default value
                    'hint' => 'Nombre de la app' // help block text for input
                ],
                [
                    'name' => 'payment_prefix', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Prefijo para pagos', // label for input
                    // optional properties
                    'placeholder' => 'Prefijo para pagos', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:2|max:20', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => 'Prefijo para pagos' // help block text for input
                ],
                [
                    'name' => 'expense_prefix', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Prefijo para gastos', // label for input
                    // optional properties
                    'placeholder' => 'Prefijo para gastos', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:2|max:20', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => 'Prefijo para gastos' // help block text for input
                ]
            ]
        ],
        'cotizaciones' => [
            'title' => 'Cotizaciones',
            'descriptions' => 'Configuración de cotizaciones',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'abono',
                    'type' => 'number',
                    'label' => 'Abono inicial',
                    'placeholder' => 'Abono inicial',
                    'rules' => '',
                ],
                [
                    'name' => 'deposito',
                    'type' => 'number',
                    'label' => 'Depósito por evento',
                    'placeholder' => 'Depósito por evento',
                ],
                [
                    'name' => 'valid_thru',
                    'type' => 'number',
                    'label' => 'Vigencia máxima de la cotización (días)',
                    'placeholder' => 'Vigencia máxima',
                ]
            ]
        ],
        'Enero' => [
            'title' => 'Descuentos de enero',
            'descriptions' => 'Descuentos en enero',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'enero_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'enero_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'enero_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'enero_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'Febrero' => [
            'title' => 'Descuentos de febrero',
            'descriptions' => 'Descuentos en febrero',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'febrero_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'febrero_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'febrero_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'febrero_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'marzo' => [
            'title' => 'Descuentos de marzo',
            'descriptions' => 'Descuentos en marzo',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'marzo_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'marzo_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'marzo_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'marzo_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'abril' => [
            'title' => 'Descuentos de abril',
            'descriptions' => 'Descuentos en abril',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'abril_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'abril_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'abril_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'abril_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'mayo' => [
            'title' => 'Descuentos de mayo',
            'descriptions' => 'Descuentos en mayo',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'mayo_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'mayo_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'mayo_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'mayo_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'junio' => [
            'title' => 'Descuentos de junio',
            'descriptions' => 'Descuentos en junio',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'junio_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'junio_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'junio_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'junio_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'julio' => [
            'title' => 'Descuentos de julio',
            'descriptions' => 'Descuentos en julio',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'julio_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'julio_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'julio_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'julio_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'agosto' => [
            'title' => 'Descuentos de agosto',
            'descriptions' => 'Descuentos en agosto',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'agosto_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'agosto_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'agosto_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'agosto_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'septiembre' => [
            'title' => 'Descuentos de septiembre',
            'descriptions' => 'Descuentos en septiembre',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'septiembre_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'septiembre_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'septiembre_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'septiembre_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'octubre' => [
            'title' => 'Descuentos de octubre',
            'descriptions' => 'Descuentos en octubre',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'octubre_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'octubre_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'octubre_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'octubre_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'noviembre' => [
            'title' => 'Descuentos de noviembre',
            'descriptions' => 'Descuentos en noviembre',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'noviembre_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'noviembre_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'noviembre_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'noviembre_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ],
        'diciembre' => [
            'title' => 'Descuentos de diciembre',
            'descriptions' => 'Descuentos en diciembre',
            'icon' => 'fa fa-money',

            'inputs' => [
                [
                    'name' => 'diciembre_viernes',
                    'type' => 'select',
                    'label' => 'Viernes',
                    'placeholder' => 'Viernes',
                    'rules' => '',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ],

                ],
                [
                    'name' => 'diciembre_sabado',
                    'type' => 'select',
                    'label' => 'Sabado',
                    'placeholder' => 'Sabado',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'diciembre_domingo',
                    'type' => 'select',
                    'label' => 'Domingo',
                    'placeholder' => 'Domingo',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ],
                [
                    'name' => 'diciembre_weekdays',
                    'type' => 'select',
                    'label' => 'Días entre semana',
                    'placeholder' => 'Días entre semana',
                    'options' => [
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                    ]
                ]
            ]
        ]
    ],

    // Setting page url, will be used for get and post request
    'url' => 'settings',

    // Any middleware you want to run on above route
    'middleware' => [],

    // View settings
    'setting_page_view' => 'general_settings',
    'flash_partial' => 'app_settings::_flash',

    // Setting section class setting
    'section_class' => 'card mb-3',
    'section_heading_class' => 'card-header',
    'section_body_class' => 'card-body',

    // Input wrapper and group class setting
    'input_wrapper_class' => 'form-group',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',

    // Submit button
    'submit_btn_text' => 'Guardar configuración',
    'submit_success_message' => 'Se ha guardado la configuración.',

    // Remove any setting which declaration removed later from sections
    'remove_abandoned_settings' => false,

    // Controller to show and handle save setting
    'controller' => '\QCod\AppSettings\Controllers\AppSettingController',

    // settings group
    'setting_group' => function() {
        //return 'user_'.auth()->id();
        //return '';
        return 'default';
    }
];
