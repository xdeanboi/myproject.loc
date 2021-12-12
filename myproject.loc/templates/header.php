<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Мой блог'?></title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">
            <? if(!empty($user)):?>
            Привет, <strong><a href="/users/info/<?= $user->getId()?>" style="text-decoration: none; color: black">
                        <?= $user->getNickname()?></a></strong> |
                <a href="/users/login/exit">Выйти</a>
            <? else:?>
                <a href="/users/login">Войти</a> | <a href="/users/register">Регистрация</a>
            <? endif;?>
        </td>
    </tr>
    <tr>
        <td>