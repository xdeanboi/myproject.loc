<?php

return [
    '~^about-me$~' => [\MyProject\Controllers\UserController::class, 'aboutMe'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticleController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticleController::class, 'edit'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticleController::class, 'add'],
    '~^articles/(\d+)/delete$~' => [\MyProject\Controllers\ArticleController::class, 'delete'],
    '~^users/register$~' => [\MyProject\Controllers\UserController::class, 'signUp'],
    '~^users/(\d+)/activation/(.*)$~' => [\MyProject\Controllers\UserController::class, 'activate'],
    '~^users/login$~' => [\MyProject\Controllers\UserController::class, 'login'],
    '~^users/login/exit$~' => [\MyProject\Controllers\UserController::class, 'loginOut'],
    '~^users/info/(\d+)$~' => [\MyProject\Controllers\UserController::class, 'info'],
    '~^articles/(\d+)/comments$~' => [\MyProject\Controllers\CommentsController::class, 'add'],
    '~^articles/(\d+)/comments/(\d+)/edit$~' => [\MyProject\Controllers\CommentsController::class, 'edit'],
    '~^articles/(\d+)/comments/(\d+)/delete$~' => [\MyProject\Controllers\CommentsController::class, 'delete'],
    '~^admin$~' => [\MyProject\Controllers\AdminController::class, 'view'],
    '~^admin/articles/last$~' => [\MyProject\Controllers\AdminController::class, 'articlesView'],
    '~^admin/comments/last$~' => [\MyProject\Controllers\AdminController::class, 'commentsView'],
    '~^admin/users/last$~' => [\MyProject\Controllers\AdminController::class, 'usersView'],
];