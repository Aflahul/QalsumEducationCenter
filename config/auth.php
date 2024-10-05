<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Mengatur default guard dan broker reset password. Pastikan ini sesuai
    | dengan model Pengguna untuk autentikasi dan reset password.
    |
    */
    'defaults' => [
        'guard' => 'web', // Gunakan guard 'web' yang akan mengarahkan ke model Pengguna
        'passwords' => 'pengguna', // Menggunakan 'pengguna' untuk reset password
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Guard untuk mengatur mekanisme autentikasi. Gunakan session storage
    | dan provider untuk model Pengguna.
    |
    */
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'pengguna', // Pastikan menggunakan provider Pengguna
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Provider mengatur bagaimana pengguna diambil dari database atau sistem
    | penyimpanan lain. Kita menggunakan Eloquent untuk model Pengguna.
    |
    */
    'providers' => [
        'pengguna' => [
            'driver' => 'eloquent',
            'model' => App\Models\Pengguna::class, // Model Pengguna untuk autentikasi
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk reset password, pastikan menggunakan provider 'pengguna'
    | dan tabel penyimpanan token reset yang sesuai.
    |
    */
    'passwords' => [
        'pengguna' => [
            'provider' => 'pengguna', // Menggunakan provider Pengguna untuk reset password
            'table' => 'password_reset_tokens', // Tabel untuk menyimpan token reset
            'expire' => 60, // Token reset berlaku selama 60 menit
            'throttle' => 60, // Pengguna harus menunggu 60 detik sebelum meminta token reset lagi
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Timeout untuk konfirmasi password. Default adalah 3 jam.
    |
    */
    'password_timeout' => 10800,

];
