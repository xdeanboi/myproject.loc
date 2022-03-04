<div>
    <h2>Коментарии: </h2>
    <?php if (!empty($error)): ?>
        <div style="text-align: center; color: red">
            <p><strong><?= $error ?></strong></p>
        </div>
    <?php endif; ?>
    <hr>
    <? if (!empty($commentError)): ?>
        <div style="text-align: center; color: grey">
            <p><?= $commentError ?></p>
        </div>
    <? endif; ?>
    <? if (!empty($comments)): ?>
        <? foreach ($comments as $comment): ?>
            <div style="border: 1px solid black; padding: 10px">
                <? if ($comment->getAuthor()->isAdmin()): ?>
                    <div id="#comments<?=$comment->getId()?>">
                        <? if ($user->isAdmin()): ?>
                            <? include __DIR__ . '/divButton.php' ?>
                        <? endif; ?>
                        <p><span style="color: red">Админ:</span>
                            <strong><?= $comment->getAuthor()->getNickname() ?></strong>
                        </p>
                        <p><?= $comment->getText() ?></p><br>
                    </div>
                <? elseif ($user->getId() === $comment->getAuthorId() || $user->isAdmin()): ?>
                    <div id="#comments<?=$comment->getId()?>">
                        <? include __DIR__ . '/divButton.php' ?>
                        <p><span style="color: blue">Пользователь:</span>
                            <strong><?= $comment->getAuthor()->getNickname() ?></strong></p>
                        <p><?= $comment->getText() ?></p><br>
                    </div>
                <? else: ?>
                    <div id="#comments<?=$comment->getId()?>">
                        <p><span style="color: blue">Пользователь:</span>
                            <strong><?= $comment->getAuthor()->getNickname() ?></strong></p>
                        <p><?= $comment->getText() ?></p><br>
                    </div>
                <? endif; ?>
            </div>
            <br>
        <? endforeach; ?>
    <? endif; ?>

    <div>
        <form action="/articles/<?= $article->getId() ?>/comments" method="post">
            <label for="text">
                <textarea name="text" cols="84" rows="5" placeholder="Введите комментарий"></textarea>
            </label>
            <br>
            <input type="submit" value="Комментировать">
        </form>
    </div>
</div>
