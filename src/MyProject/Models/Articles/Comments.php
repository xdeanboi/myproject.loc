<?php

namespace MyProject\Models\Articles;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

class Comments extends ActiveRecordEntity
{
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getAuthor(): User
    {
        return User::getById((int)$this->authorId);
    }

    /**
     * @param int $authorId
     */
    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getArticle(): Article
    {
        return Article::getById((int)$this->articleId);
    }

    /**
     * @param int $articleId
     */
    public function setArticleId(int $articleId): void
    {
        $this->articleId = $articleId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    protected static function getTableName(): string
    {
        return 'comments';
    }

    public static function add(Article $article, User $user, array $fieldsComment): ?self
    {
        if (empty($user)) {
            throw new NotFoundException();
        }

        if (empty($user)) {
            throw new UnauthorizedException();
        }

        if (empty($fieldsComment['text'])) {
            throw new InvalidArgumentException('Комментарий не может быть пустым');
        }

        $comment = new Comments();
        $comment->setArticleId($article->getId());
        $comment->setAuthorId($user->getId());
        $comment->setText($fieldsComment['text']);

        $comment->save();

        return $comment;
    }

    public function edit(array $fieldsComment): self
    {
        if (empty($fieldsComment['text'])) {
            throw new InvalidArgumentException('Комментарий не может быть пустым');
        }

        $this->setText($fieldsComment['text']);
        $this->save();

        return $this;
    }
}
