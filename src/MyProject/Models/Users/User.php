<?php

namespace MyProject\Models\Users;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected $nickname;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $createdAt;

    public static function getTableName(): string
    {
        return 'users';
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setIsConfirmed(bool $isConfirmed)
    {
        $this->isConfirmed = $isConfirmed;
    }

    public function getIsConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    public function isAdmin(): bool
    {
        return $this->getRole() == 'admin';
    }

    /**
     * @param string $passwordHash
     */
    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @param string $authToken
     */
    public function setAuthToken(string $authToken): void
    {
        $this->authToken = $authToken;
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public static function signUp(array $userFields): User
    {
        if (empty($userFields['nickname'])) {
            throw new InvalidArgumentException('Заполните поле Nickname');
        }

        if (!preg_match('~^[a-zA-Z0-9]+$~', $userFields['nickname'])) {
            throw new InvalidArgumentException('Nickname может содержать только латинские символы алфавита и цифры');
        }

        if (empty($userFields['email'])) {
            throw new InvalidArgumentException('Заполните поле Email');
        }

        if (!filter_var($userFields['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Некоректен Email');
        }

        if (empty($userFields['password'])) {
            throw new InvalidArgumentException('Заполните поле Password');
        }

        if (mb_strlen($userFields['password']) < 8) {
            throw new InvalidArgumentException('Password не может содержать менее 8 символов');
        }

        if (static::findByOneColumn('nickname', $userFields['nickname']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким Nickname уже существует');
        }

        if (static::findByOneColumn('email', $userFields['email']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким Email уже сущесвует');
        }

        $user = new User();

        $user->setNickname($userFields['nickname']);
        $user->setEmail($userFields['email']);
        $user->setIsConfirmed(false);
        $user->setRole('user');
        $user->setPasswordHash(password_hash($userFields['password'], PASSWORD_DEFAULT));
        $user->setAuthToken(sha1(random_bytes(100)) . sha1(random_bytes(100)));

        $user->save();

        return $user;
    }

    public function activate():void
    {
        if ($this->getIsConfirmed()) {
            throw new InvalidArgumentException('Пользователь уже активирован');
        }

        $this->setIsConfirmed(true);
        $this->save();
    }

    public function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    public static function login(array $userFields): User
    {
        if (empty($userFields['email'])) {
            throw new InvalidArgumentException('Заполните поле Email');
        }

        if (empty($userFields['password'])) {
            throw new InvalidArgumentException('Заполните поле Password');
        }

        $user = User::findByOneColumn('email', $userFields['email']);

        if ($user === null) {
            throw new InvalidArgumentException('Пользователя с таким Email не существует');
        }

        if (!password_verify($userFields['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Неверный пароль');
        }

        if (!$user->getIsConfirmed()) {
            throw new InvalidArgumentException('Пользователь не активирован');
        }

        $user->refreshAuthToken();
        $user->save();

        return $user;
    }
}