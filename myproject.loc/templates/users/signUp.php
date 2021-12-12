<?php include __DIR__ . '/../header.php' ?>
<div style="text-align: center">
    <h1>Регистрация</h1>
    <form action="/users/register" method="post">
        <? if (!empty($error)): ?>
            <div style="text-align: center">
                <p style="text-align: center; color: red"><strong><?= $error ?></strong></p>
            </div>
        <? endif; ?>
        <label for="Nickname">Nickname <input type="text" name="nickname"
                                              value="<?= $_POST['nickname'] ?? '' ?>"></label>
        <br><br>
        <label for="Email">Email <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
        <br><br>
        <label for="Password">Password <input type="password" name="password"></label>
        <br><br>
        <input type="submit" value="Зарегистрировать">
    </form>
</div>
<?php include __DIR__ . '/../footer.php' ?>
