<?php include __DIR__ . '/../header.php'?>
<div style="text-align: center">
    <h1>Создание статьи</h1>
    <form action="/articles/add" method="post" style="text-align: left">
        <? if (!empty($error)):?>
        <div>
            <p style="text-align: center; color: red"><strong><?= $error?></strong></p>
        </div>
        <? endif;?>
        <label for="name"><h3>Название статьи: </h3>
            <input type="text" name="name" value="<?= $_POST['name'] ?? ''?>" size="51">
        </label>
        <br>
        <label for="text"><h3>Текст статьи: </h3>
            <textarea name="text" cols="48" rows="10"><?= $_POST['text'] ?? ''?></textarea>
        </label>
        <br>
        <div style=" position:relative; left: 300px">
            <input type="submit" value="Создать" >
        </div>
    </form>
</div>
<?php include __DIR__ . '/../footer.php'?>
