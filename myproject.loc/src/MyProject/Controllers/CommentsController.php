<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\CommentException;
use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\Comments;

class CommentsController extends AbstractController
{
    public function add(int $articleId): void
    {
        $article = Article::getById($articleId);

        if (empty($article)) {
            throw new NotFoundException();
        }

        $comments = Comments::findAllByColumn('article_id', $articleId);

        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $comment = Comments::add($article, $this->user, $_POST);

                header('Location: /articles/' . $articleId, true, 302);
                return;
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/view.php',
                    ['article' => $article,
                        'comments' => $comments,
                        'error' => $e->getMessage()]);
            }
            return;
        }

        $this->view->renderHtml('articles/view.php',
            ['article' => $article,
                'comments' => $comments]);
    }

    public function edit(int $articleId, int $commentId): void
    {
        //измениение, удаление комментов

        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        $article = Article::getById($articleId);

        if (empty($article)) {
            throw new NotFoundException('Статья не найдена');
        }

        $comment = Comments::getById($commentId);

        if (empty($comment)) {
            throw new NotFoundException('Комментарий не найден');
        }


        if ($this->user->getId() !== $comment->getAuthorId() && !$this->user->isAdmin()) {
            throw new ForbiddenException('Вы не можете изменить этот комментарий');
        }

        if (!empty($_POST)) {
            try {
                $comment->edit($_POST);

                header('Location: /articles/' . $article->getId(), true, 302);
                return;
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/comments/edit.php',
                    ['article' => $article,
                        'comment' => $comment,
                        'error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('articles/comments/edit.php',
            ['article' => $article,
                'comment' => $comment]);
    }

    public function delete(int $articleId, int $commentId): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        $article = Article::getById($articleId);

        if (empty($article)) {
            throw new NotFoundException('Статья не найдена');
        }

        $comment = Comments::getById($commentId);

        if (empty($comment)) {
            throw new NotFoundException('Комментарий не найден');
        }

        if ($this->user->getId() !== $comment->getAuthorId() && !$this->user->isAdmin()) {
            throw new ForbiddenException('Вы не можете удалить этот комментарий');
        }

        $comment->delete();

        header('Location: /articles/' . $article->getId(), true, 302);
        return;
    }
}