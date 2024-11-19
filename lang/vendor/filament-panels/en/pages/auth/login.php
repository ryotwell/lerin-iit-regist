<?php

return [

    'title' => 'Login',

    'heading' => 'Masuk',

    'actions' => [

        'register' => [
            'before' => 'atau',
            'label' => 'belum punya akun? daftar disini',
        ],

        'request_password_reset' => [
            'label' => 'Forgot password?',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'Alamat Email',
        ],

        'password' => [
            'label' => 'Password',
        ],

        'remember' => [
            'label' => 'Ingat saya',
        ],

        'actions' => [

            'authenticate' => [
                'label' => 'Masuk',
            ],

        ],

    ],

    'messages' => [

        'failed' => 'These credentials do not match our records.',

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'Too many login attempts',
            'body' => 'Please try again in :seconds seconds.',
        ],

    ],

];
