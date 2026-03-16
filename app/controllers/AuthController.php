<?php

class AuthController extends Controller
{

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            $auth = new AuthModel();
            $user = $auth->login($email, $password);

            if (!$user) {

                return $this->render('auth/login', [
                    'error' => 'Identifiants invalides'
                ]);

            }

            $_SESSION['user'] = [
                'id' => $user['id_ident'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'role_id' => $user['id_role'],
                'role' => $user['role']
            ];

            $_SESSION['permissions'] = $auth->getPermissions($user['id_role']);

            $this->redirect('/home/index');

        }

        $this->render('auth/login');
    }


    public function logout()
    {
        Auth::logout();

        header('Location: /home');
        exit;
    }

}