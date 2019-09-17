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
        // return 'user_'.auth()->id();
        return 'default';
    }
];
