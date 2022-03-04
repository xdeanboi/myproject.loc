<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Models\Users\UserAuthService;
use MyProject\Services\EmailSender;

class UserController extends AbstractController
{
    public function signUp()
    {
        if (!empty($this->user)) {
            throw new ForbiddenException('Вы уже авторизованы');
        }

        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php',
                    ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                EmailSender::send($user,
                    'Активация аккаута',
                    'userActivation.php',
                    ['userId' => $user->getId(),
                        'code' => $code]);

                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php');
    }

    public function activate(int $userId, string $code)
    {
        if (!empty($this->user)) {
            throw new ForbiddenException('Вы уже авторизованы');
        }

        try {
            $user = User::getById($userId);

            if (empty($user)) {
                throw new InvalidArgumentException('Пользователя не найдено');
            }

            $checkActivationCode = UserActivationService::checkActivationCode($user, $code);

            if (!$checkActivationCode) {
                throw new InvalidArgumentException('Неверный код активации');
            }

            if ($checkActivationCode) {
                $user->activate();

                UserActivationService::deleteCode($user, $code);

                header('Location: /', true);
                return;
            }
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('errors/userActivate.php',
                ['error' => $e->getMessage()]);
        }
    }

    public function login()
    {
        if (!empty($this->user)) {
            throw new ForbiddenException('Вы уже авторизованы');
        }

        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);

                UserAuthService::createToken($user);

                header('Location: /');
                return;
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('users/login.php');
    }

    public function loginOut()
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        setcookie('token', '', -1, '/', '');

        header('Location: /users/login', true, 302);
        return;
    }

    public function info(int $userId): void
    {
        if (empty($this->user)) {
            throw new UnauthorizedException();
        }

        $userInfo = User::getById($userId);

        if (empty($userInfo)) {
            throw new NotFoundException('Такого пользователя не сущесвует');
        }

        $this->view->renderHtml('users/info.php', ['userInfo' => $userInfo]);
    }

    public function aboutMe(): void
    {
        $this->view->renderHtml('users/aboutMe.php');
    }
}