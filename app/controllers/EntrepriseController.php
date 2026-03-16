<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Validator.php';

class EntrepriseController extends Controller
{
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filters = [
                'nom' => $_POST['nom'] ?? null,
                'description' => $_POST['description'] ?? null,
                'telephone' => $_POST['telephone'] ?? null,
                'email' => $_POST['email'] ?? null,
            ];

            $validator = new Validator();
            $valid = $validator->validate($_POST, [
                'nom' => ['required', 'alpha'],
                'description' => ['required'],
                'telephone' => ['required'],
                'email' => ['required', 'email']
            ]);

            if (!$valid) {
                return $this->render('entreprise/create', [
                    'errors' => $validator->errors(),
                    'filters' => $filters,
                    'results' => [],
                ]);
            }

            $entreprise = $this->getEntrepriseModel();
            $entreprise->create($filters);

            $this->redirect('/entreprise/recherche');
        }

        $this->render('entreprise/create');
    }

    public function recherche()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $page = $_POST['page'] ?? 1;
            $page = max(1, (int)$page);

            $perPage = 3;
            $filters = [
                'nom' => $_POST['nom'] ?? null,
                'description' => $_POST['description'] ?? null,
                'telephone' => $_POST['telephone'] ?? null,
                'email' => $_POST['email'] ?? null,
            ];

            $validator = new Validator();
            $valid = true;

            if (!empty($_POST['nom'])) {
                $valid = $validator->validate($_POST, ['nom' => ['required', 'alpha']]);
            }

            if (!empty($_POST['description'])) {
                $valid = $validator->validate($_POST, [
                    'description' => ['required'],
                    'telephone' => ['required'],
                    'email' => ['required', 'email']
                ]);
            }

            if (!$valid) {
                return $this->render('entreprise/recherche', [
                    'errors' => $validator->errors(),
                    'filters' => $filters,
                    'results' => [],
                    'page' => 1,
                    'totalPages' => 0,
                    'pagination' => [],
                ]);
            }
            if (empty($retour['errors'])){
                $entreprise = $this->getEntrepriseModel();
                $data = $entreprise->search($filters, $page, $perPage);

                $results = $data['results'];
                $total = $data['total'];

                $totalPages = ceil($total / $perPage);

                $retour = [
                    'errors' => null,
                    'filters' => $filters,
                    'results' => $results,
                    'page' => $page,
                    'totalPages' => $totalPages,
                    'pagination' => View::buildPagination($page, $totalPages),
                ];
            }
            return $this->render('entreprise/recherche', [
                'errors' => null,
                'filters' => $filters,
                'results' => $results,
                'page' => $page,
                'totalPages' => $totalPages,
                'pagination' => View::buildPagination($page, $totalPages),
            ]);
        }

        $this->render('entreprise/recherche');
    }

    public function modify($id)
    {
        $entrepriseModel = $this->getEntrepriseModel();
        $entreprise = $entrepriseModel->findById($id);

        if (!$entreprise) {
            if (defined('PHPUNIT_RUNNING')) {
                throw new \Exception("Entreprise introuvable");
            }
            http_response_code(404);
            die("Entreprise introuvable");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $entreprise = [
                'nom' => $_POST['nom'] ?? null,
                'description' => $_POST['description'] ?? null,
                'telephone' => $_POST['telephone'] ?? null,
                'email' => $_POST['email'] ?? null,
            ];

            $validator = new Validator();
            $valid = $validator->validate($_POST, [
                'nom' => ['required', 'alpha'],
                'description' => ['required'],
                'telephone' => ['required'],
                'email' => ['required', 'email']
            ]);

            if (!$valid) {
                return $this->render('entreprise/modify', [
                    'errors' => $validator->errors(),
                    'entreprise' => $entreprise,
                ]);
            }

            $entrepriseModel->update($id, $entreprise);

            // Toujours passer par redirect, mockable en test
            $this->redirect('/entreprise/recherche');
        }

        $this->render('entreprise/modify', [
            'entreprise' => $entreprise,
            'errors' => [],
        ]);
    }

    public function delete($id)
    {
        $entrepriseModel = $this->getEntrepriseModel();
        $entrepriseModel->delete($id);

        $this->redirect('/entreprise/recherche');
    }

    protected function redirect($url)
    {
        if (defined('PHPUNIT_RUNNING')) {
            return; // mockable en test
        }
        header("Location: $url");
        exit;
    }

    protected function getEntrepriseModel()
    {
        return new Entreprise();
    }
}