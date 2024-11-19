<?php

return [

    'title' => 'Register',

    'heading' => 'Daftar',

    'actions' => [

        'login' => [
            'before' => 'atau',
            'label' => 'sudah punya akun? masuk disini',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'Alamat Email',
        ],

        'name' => [
            'label' => 'Nama Tim',
        ],

        'password' => [
            'label' => 'Password',
            'validation_attribute' => 'password',
        ],

        'password_confirmation' => [
            'label' => 'Confirm password',
        ],

        'actions' => [

            'register' => [
                'label' => 'Daftar',
            ],

        ],

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'Too many registration attempts',
            'body' => 'Please try again in :seconds seconds.',
        ],

    ],

];
