<?php include __DIR__ . '/../header.php' ?>
<?php if (!empty($user) && $user->isAdmin()): ?>
    <div style="text-align: right">
        <button><a style="text-decoration: none; color: black" href="/articles/<?= $article->getId() ?>/edit">Редактировать</a>
        </button>
        <button><a style="text-decoration: none; color: black" href="/articles/<?= $article->getId() ?>/delete">X</a>
        </button>
    </div>
<?php endif; ?>
<div><h2><?= $article->getName() ?></h2>
    <p><?= $article->getText() ?></p>
    <p>Автор: <strong><?= $article->getAuthor()->getNickname() ?></strong></p>
</div>
<br>
<?php include __DIR__ . '/comments/comments.php' ?>
<?php include __DIR__ . '/../footer.php' ?>
