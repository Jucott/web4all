<?php

class AuthModel extends Model
{
    public function login($email, $password)
    {
        $sql = "
            SELECT i.*, r.role
            FROM ident i
            JOIN role r ON r.id_role = i.id_role
            WHERE i.email = :email
            AND i.valide = true
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        if ($user['passwd'] !== $password) {
            return false;
        }

        return $user;
    }

    public function getPermissions($roleId)
    {
        $sql = "SELECT permission, allowed FROM permission WHERE id_role = :role";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['role' => $roleId]);

        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }
}