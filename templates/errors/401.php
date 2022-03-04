<?php include __DIR__ . '/../header.php'?>
<div style="text-align: center">
    <h1>Вы не авторизованы</h1>
    <p>Для доступа к этой странице вам нужно <a href="/users/login">авторизоваться</a></p><br>
    <p style="color: red"><?= $error?></p>
</div>
<?php include __DIR__ . '/../footer.php'?>
