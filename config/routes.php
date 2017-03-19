<?php

use GifTube\controllers\GifController;
use GifTube\controllers\UserController;

return [
    'signup' => [UserController::class, 'actionSignup'],
    'signin' => [UserController::class, 'actionSignin'],
    'logout' => [UserController::class, 'actionLogout'],
    'gif\/add' => [GifController::class, 'actionAdd'],
];