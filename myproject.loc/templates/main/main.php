<?php include __DIR__ . '/../header.php' ?>
<?php foreach ($articles as $article): ?>
    <h2><a href="/articles/<?= $article->getId()?>"><?= $article->getName() ?></a></h2>
    <p><?= mb_substr($article->getText(), 0, 80) ?> . . . <a href="/articles/<?= $article->getId()?>" style="color: grey; text-decoration: none"> (Продолжить)</a></p>
    <hr>
<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php' ?>
