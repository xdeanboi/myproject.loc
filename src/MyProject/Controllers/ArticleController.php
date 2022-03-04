<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\CommentException;
use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\Comments;

class ArticleController extends AbstractController
{
    public function view(int $articleId): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException('Статья не найдена');
        }

        try {

            $comments = Comments::findAllByColumn('article_id', $articleId);

            if ($comments === null) {
                throw new CommentException('Можете оставить комментарий первым');
            }

        } catch (CommentException $e) {
            $this->view->renderHtml('articles/view.php',
                ['article' => $article,
                'commentError' => $e->getMessage()]);
            return;
        }

        $this->view->renderHtml('articles/view.php',
            ['article' => $article,
                'comments' => $comments]);
    }

    public function edit(int $articleId): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас нет прав доступа');
        }

        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException('Статья не найдена');
        }

        if (!empty($_POST)) {
            try {
                $article->edit($_POST);

                header('Location: /articles/' . $article->getId(), true, 302);
                return;
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php',
                    ['article' => $article,
                        'error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function add(): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас нет доступа к этой странице');
        }

        if (!empty($_POST)) {
            try {
                $article = Article::add($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php',
                    ['error' => $e->getMessage()]);
                return;
            }
            header('Location: /articles/' . $article->getId(), true, 302);
            return;
        }

        $this->view->renderHtml('articles/add.php');
    }

    public function delete(int $articleId): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас нет прав доступа');
        }

        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException('Статья не найдена');
        }

        $article->delete();

        header('location: /', true, 302);
        return;
    }
}