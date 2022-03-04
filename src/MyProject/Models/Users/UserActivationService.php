<?php

namespace MyProject\Models\Users;

use MyProject\Services\Db;

class UserActivationService
{
    private const TABLE_NAME = 'users_activation_codes';

    public static function createActivationCode(User $user): string
    {
        $code = bin2hex(random_bytes(10));

        $db = Db::getInstance();

        $db->query('INSERT INTO `' . self::TABLE_NAME . '` (user_id, code) VALUES (:userId, :code);',
            [':userId' => $user->getId(),
                ':code' => $code]);

        return $code;
    }

    public static function checkActivationCode(User $user, string $code): bool
    {
        $db = Db::getInstance();

        $result = $db->query('SELECT * FROM `' . self::TABLE_NAME . '` WHERE user_id = :userId AND code = :code',
            [':userId' => $user->getId(),
                ':code' => $code]);

        return !empty($result);
    }

    public static function deleteCode(User $user, string $code): void
    {
        $db = Db::getInstance();

        $db->query('DELETE FROM `' . self::TABLE_NAME . '` WHERE user_id = :userId AND code = :code',
            [':userId' => $user->getId(),
                ':code' => $code]);
    }
}