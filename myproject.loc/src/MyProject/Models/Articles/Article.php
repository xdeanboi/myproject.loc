<?php

namespace MyProject\Models\Articles;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

class Article extends ActiveRecordEntity
{
    protected $authorId;
    protected $name;
    protected $text;
    protected $createdAt;

    protected static function getTableName(): string
    {
        return 'articles';
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function setAuthorId(int $authorId)
    {
        $this->authorId = $authorId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public static function add(array $fields, User $author): self
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Заполните поле Название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Поле текст статьи не может быть пустым');
        }

        if (empty($author)) {
            throw new UnauthorizedException();
        }

        if (!$author->isAdmin()) {
            throw new ForbiddenException('У вас нет доступа к этой странице');
        }

        $article = new Article();
        $article->setName($fields['name']);
        $article->setText($fields['text']);
        $article->setAuthorId($author->getId());

        $article->save();

        return $article;
    }

    public function edit(array $articleFields): self
    {
        if (empty($articleFields['name'])) {
            throw new InvalidArgumentException('Заполните поле Название статьи');
        }

        if (empty($articleFields['text'])) {
            throw new InvalidArgumentException('Заполните поле Текст статьи');
        }

        $this->setName($articleFields['name']);
        $this->setText($articleFields['text']);

        $this->save();

        return $this;
    }
}