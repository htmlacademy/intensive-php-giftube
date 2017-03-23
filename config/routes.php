<?php

use GifTube\controllers\CategoryController;
use GifTube\controllers\GifController;
use GifTube\controllers\MainController;
use GifTube\controllers\UserController;

return [
    'signup'    => [UserController::class, 'actionSignup'],
    'signin'    => [UserController::class, 'actionSignin'],
    'logout'    => [UserController::class, 'actionLogout'],
    'favorites' => [UserController::class, 'actionFavorites'],
    'gif\/add'  => [GifController::class, 'actionAdd'],
    'gif\/view' => [GifController::class, 'actionView'],
    'gif\/like' => [GifController::class, 'actionLike'],
    'gif\/fav'  => [GifController::class, 'actionFav'],
    'category'  => [CategoryController::class, 'actionIndex'],
    'search'    => [MainController::class, 'actionSearch'],
];