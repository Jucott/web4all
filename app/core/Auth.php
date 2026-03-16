<?php

class Auth
{
    public static function user()
    {
        return $_SESSION['user'] ?? null;
    }

    public static function check()
    {
        return isset($_SESSION['user']);
    }

    public static function role()
    {
        return $_SESSION['user']['role'] ?? 'guest';
    }

    public static function roleId()
    {
        if (!self::check()) {
            // id_role du guest
            return 4;
        }
        return $_SESSION['user']['id'];
    }

    public static function can($permission, $roleId)
    {
        //$roleId = self::roleId();

        $db = Database::getInstance();

        $stmt = $db->prepare("
            SELECT allowed
            FROM permission
            WHERE id_role = :role
            AND permission = :perm
        ");

        $stmt->execute([
            'role' => $roleId,
            'perm' => $permission
        ]);

        return (bool) $stmt->fetchColumn();
    }

    public static function logout()
    {
        $_SESSION = [];
        session_destroy();
    }
}