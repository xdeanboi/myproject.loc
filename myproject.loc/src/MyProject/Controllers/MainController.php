<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;

class MainController extends AbstractController
{
    public function main()
    {
        $articles = Article::findAll();

        if ($articles === null) {
            throw new NotFoundException('Articles not found!');
        }

        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function sayHello(string $name)
    {
        echo 'Hello, my friend - ' . $name;
    }

    public function sayBye(string $name)
    {
        echo 'Miss you, bye - ' . $name;
    }
}