<?php

class Menu
{

    public static function get()
    {

        $db = Database::getInstance();

        $role = Auth::roleId();

        $sql = "
            SELECT 
                pf.permission,
                pf.menu,
                pf.label,
                pf.url
            FROM page_fonction pf
            JOIN permission p
                ON p.permission = pf.permission
            WHERE p.id_role = :role
            AND p.allowed = true
            ORDER BY pf.menu_order, pf.item_order
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute(['role' => $role]);

        $rows = $stmt->fetchAll();

        $menu = [];

        foreach ($rows as $row) {

            $menuName = $row['menu'];

            if (!isset($menu[$menuName])) {
                $menu[$menuName] = [];
            }

            $menu[$menuName][] = [
                'label' => $row['label'],
                'url' => '/' . $row['url']
            ];
        }

        return $menu;
    }

}