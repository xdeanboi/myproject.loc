<?php include __DIR__ . '/../header.php' ?>
<div>
    <h1 style="text-align: center">Список последних статтей</h1>
    <? foreach ($articles as $article): ?>
        <h2><a href="/articles/<?= $article->getId()?>"><?= $article->getName() ?></a></h2>
        <p><?= mb_substr($article->getText(), 0, 30) ?> . . . <a href="/articles/<?= $article->getId()?>" style="color: grey; text-decoration: none"> (Продолжить)</a></p>
        <p>Автор: <strong><a href="/users/info/<?= $article->getAuthorId()?>" style="text-decoration: none; color: black"><?= $article->getAuthor()->getNickname() ?></a></strong></p>
        <p>Дата: <?= $article->getCreatedAt() ?></p>
        <hr>
    <? endforeach; ?>
</div>
<?php include __DIR__ . '/../footer.php' ?>
