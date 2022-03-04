<?php include __DIR__ . '/../header.php' ?>
    <div>
        <h1>Информация о пользователе</h1>
        <div style="border: 2px solid black; padding: 20px; margin: 5px">
            <p>Никнейм: <strong><?= $userInfo->getNickname() ?></strong> </p>
            <p>Email: <em style="color: darkblue"><?= $userInfo->getEmail() ?></em></p>
            <p>Роль: <?= $userInfo->getRole() === 'admin' ? '<strong style="color: red">Админ</strong>' : '<strong style="color: blue">Пользователь</strong>' ?></p>
            <p>Дата регистрации: <strong><em><?= $userInfo->getCreatedAt() ?></em></strong></p>
        </div>
    </div>
<?php include __DIR__ . '/../footer.php' ?>