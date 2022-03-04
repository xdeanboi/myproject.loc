<?php include __DIR__ . '/../header.php' ?>
<?php foreach ($articles as $article): ?>
    <h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p><?= mb_substr($article->getText(), 0, 80) ?> . . . <a href="/articles/<?= $article->getId() ?>"
                                                             style="color: grey; text-decoration: none">
            (Продолжить)</a></p>
    <hr>
<?php endforeach; ?>

<div style="text-align: center">
    <?php for ($pageNum = 1;
               $pageNum <= $pagesCount;
               $pageNum++): ?>
        <?php if ($nowPageNum === $pageNum): ?>
            <b><?= $pageNum ?></b>
        <? else: ?>
            <a href="/<?= $pageNum === 1 ? '' : $pageNum ?>"><?= $pageNum ?></a>
        <? endif; ?>
    <? endfor; ?>
</div>

<?php include __DIR__ . '/../footer.php' ?>
