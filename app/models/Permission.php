<?php

class Permission extends Model
{

    public function getRoles()
    {
        $sql = "SELECT * FROM role ORDER BY id_role";
        return $this->db->query($sql)->fetchAll();
    }

    public function getPermissions()
    {
        $sql = "SELECT permission FROM page_fonction ORDER BY permission";
        return $this->db->query($sql)->fetchAll();
    }

    public function getMatrix()
    {
        $sql = "SELECT id_role, permission, allowed FROM permission";

        $rows = $this->db->query($sql)->fetchAll();

        $matrix = [];

        foreach ($rows as $row) {
            $matrix[$row['id_role']][$row['permission']] = $row['allowed'];
        }

        return $matrix;
    }

    public function saveMatrix($data)
    {

        foreach ($data as $roleId => $permissions) {

            foreach ($permissions as $perm => $value) {

                $allowed = $value === "1" ? "true" : "false";

                $sql = "
                    INSERT INTO permission(id_role, permission, allowed)
                    VALUES(:role, :perm, :allowed)
                    ON CONFLICT (id_role, permission)
                    DO UPDATE SET allowed = :allowed
                ";

                $stmt = $this->db->prepare($sql);

                $stmt->execute([
                    'role' => $roleId,
                    'perm' => $perm,
                    'allowed' => $allowed
                ]);
            }
        }
    }
}