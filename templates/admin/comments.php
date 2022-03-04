<?php include __DIR__ . '/../header.php' ?>
<div>
    <h1 style="text-align: center">Список последних комментариев</h1>
    <? foreach ($comments as $comment): ?>
        <? if ($comment->getAuthor()->isAdmin()): ?>
            <p>Статья: <strong style="color: darkblue"><?= $comment->getArticle()->getName() ?></strong></p>
            <p>
                <span style="color: red">Админ: </span>
                <strong><a href="/users/info/<?= $comment->getId() ?>"
                           style="text-decoration: none; color: black"><?= $comment->getAuthor()->getNickname() ?>
                </strong></a>
            </p>
        <? else: ?>
            <p>Статья: <strong><?= $comment->getArticle()->getName() ?></strong></p>
            <p>
                <span style="color: blue">Пользователь: </span>
                <strong><a href="/users/info/<?= $comment->getId() ?>"
                           style="text-decoration: none; color: black"><?= $comment->getAuthor()->getNickname() ?>
                </strong></a>
            </p>
        <? endif; ?>
        <p>
            <a href="/articles/<?= $comment->getArticleId() ?>#comments<?= $comment->getId() ?>">Комментарий:</a> <?= $comment->getText() ?>
        </p>
        <p>Дата: <strong><em><?= $comment->getCreatedAt() ?></em></strong></p>
        <hr>
    <? endforeach; ?>
</div>
<?php include __DIR__ . '/../footer.php' ?>
