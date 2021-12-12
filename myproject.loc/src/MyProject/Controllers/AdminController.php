<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Articles\Comments;
use MyProject\Models\Users\User;

class AdminController extends AbstractController
{
    public function view(): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас нет доступа к этой странице');
        }

        $this->view->renderHtml('admin/view.php');
    }

    public function articlesView(): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас нет доступа к этой странице');
        }

        $articles = Article::findAllSortByDesc('created_at');

        $this->view->renderHtml('admin/articles.php',
            ['articles' => $articles]);
    }

    public function commentsView(): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас нет доступа к этой странице');
        }

        $comments = Comments::findAllSortByDesc('created_at');

        $this->view->renderHtml('admin/comments.php',
            ['comments' => $comments]);
    }

    public function usersView(): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new ForbiddenException('У вас нет доступа к этой странице');
        }

        $users = User::findAllSortByDesc('created_at');

        $this->view->renderHtml('admin/users.php',
            ['users' => $users]);
    }
}
