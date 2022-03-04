<?php include __DIR__ . '/../../header.php' ?>
<div style="text-align: center">
    <h1>Редактирование комментария</h1>
    <? if (!empty($error)): ?>
        <div>
            <p style="color: red"><strong><?= $error ?></strong></p>
        </div>
    <? endif; ?>
    <form action="/articles/<?= $article->getId() ?>/comments/<?= $comment->getId() ?>/edit" method="post">
        <div style="border: 2px solid black; padding: 10px">
            <p><?= $comment->getAuthor()->isAdmin() ? '<span style="color: red;">Админ:</span>' :
                    '<span style="color: blue;">Пользователь:</span>' ?>
                <?= $comment->getAuthor()->getNickname() ?></p><br>
            <label for="text">Текст комментария:
                <textarea name="text" cols="84" rows="5"><?= $_POST['text'] ?? $comment->getText() ?></textarea>
            </label>
            <input type="submit" value="Редактировать">
        </div>
    </form>
</div>
<?php include __DIR__ . '/../../footer.php' ?>
