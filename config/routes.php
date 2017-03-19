<?php

use GifTube\controllers\UserController;

return [
    'signup' => [UserController::class, 'actionSignup'],
    'signin' => [UserController::class, 'actionSignin'],
    'logout' => [UserController::class, 'actionLogout'],
];