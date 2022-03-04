<?php include __DIR__ . '/../header.php' ?>
    <div>
        <h1 style="text-align: center">Список последних пользователей </h1>
        <? foreach ($users as $user): ?>
            <div style="border: 2px solid black; padding: 20px; margin: 5px">
                <p>Пользователь: <a href="/users/info/<?= $user->getId()?>" style="color: black; text-decoration: none"><strong><?= $user->getNickname() ?></strong></a></p>
                <p>Email: <em style="color: darkblue"><?= $user->getEmail() ?></em></p>
                <p>Активирован: <?= $user->getIsConfirmed() ? '<span style="color: blue">Да</span>' : '<span style="color: red">Нет</span>' ?></p>
                <p>Роль: <?= $user->getRole() === 'admin' ? '<strong style="color: red">Админ</strong>' : '<strong style="color: blue">Пользователь</strong>' ?></p>
                <p>Дата регистрации: <strong><em><?= $user->getCreatedAt()?></em></strong></p>
            </div>
        <? endforeach; ?>

    </div>
<?php include __DIR__ . '/../footer.php' ?>