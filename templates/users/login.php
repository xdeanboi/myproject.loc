<?php include __DIR__ . '/../header.php' ?>
<div style="text-align: center">
    <h1>Авторизация</h1>
    <form action="/users/login" method="post">
        <? if (!empty($error)): ?>
            <div>
                <p style="color: red"><strong><?= $error ?></strong></p>
            </div>
        <? endif; ?>
        <label for="email">Email <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
        <br><br>
        <label for="password">Password <input type="password" name="password"></label>
        <br><br>
        <input type="submit" value="Войти">
    </form>
</div>
<?php include __DIR__ . '/../footer.php' ?>
