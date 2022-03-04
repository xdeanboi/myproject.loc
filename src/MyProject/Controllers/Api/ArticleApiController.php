<?php

namespace MyProject\Controllers\Api;

use MyProject\Controllers\AbstractController;
use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;

class ArticleApiController extends AbstractController
{
    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $this->view->displayJson([
            'article' => [$article]
            ]
        );
    }

    public function add()
    {

        $input = $this->getInputData();

        $articleFromRequest = $input['articles'][0];
        $authorId = $articleFromRequest['author_id'];

        $author = User::getById($authorId);

        if ($author === null) {
            throw new NotFoundException('Пользователь не найден');
        }

        $article = Article::add($articleFromRequest, $author);
        $article->save();

        header('Location: /api/articles/' . $article->getId(), true, 302);
        return;
    }
}