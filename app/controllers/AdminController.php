<?php

class AdminController extends Controller
{

    public function permissions()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $permModel = new Permission();

            $permModel->saveMatrix($_POST['perm'] ?? []);

            $this->redirect('/home');
            return;
        }

        $permModel = new Permission();

        $roles = $permModel->getRoles();
        $permissions = $permModel->getPermissions();
        $matrix = $permModel->getMatrix();

        $this->render('admin/permissions', [
            'roles' => $roles,
            'permissions' => $permissions,
            'matrix' => $matrix
        ]);
    }

}