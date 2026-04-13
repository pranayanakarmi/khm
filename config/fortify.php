<?php

use App\Providers\FortifyServiceProvider;
use Laravel\Fortify\Features;

return [
    'guard' => 'web',
    'middleware' => ['web'],
    'auth_middleware' => 'auth',
    'prefix' => 'fortify',
    'domain' => null,
    'home' => '/admin',
    'limiters' => [
        'login' => 'login',
        'two-factor' => 'two-factor',
    ],
    'views' => true,
    'features' => [
        Features::emailVerification(),
        Features::updateProfileInformation(),
        Features::updatePasswords(),
    ],
    'username' => 'email',
    'email' => 'email',
    'lowercase_usernames' => false,
    'passwords' => 'users',
    'password_reset_token_table' => 'password_reset_tokens',
    'storage_disk' => 'local',
];
