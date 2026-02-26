<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Validator.php';

class EntrepriseController extends Controller
{
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Filtres
            $filters = [
                'nom' => $_POST['nom'] ?? null,
                'description' => $_POST['description'] ?? null,
                'telephone' => $_POST['telephone'] ?? null,
                'email' => $_POST['email'] ?? null,
            ];
            // Validation
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

            // TODO : insertion DB plus tard
	    $entreprise = new Entreprise();
            $res = $entreprise->create($filters);
            print_r($res);

            $this->redirect('/entreprise/recherche');
        }

        $this->render('entreprise/create');
    }


    public function recherche()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Filters
            $filters = [
                'nom' => $_POST['nom'] ?? null,
                'description' => $_POST['description'] ?? null,
                'telephone' => $_POST['telephone'] ?? null,
                'email' => $_POST['email'] ?? null,
            ];
            // Validation
            $validator = new Validator();
	    $valid=true;
            // Verifier que soit "nom" est setté, 
	    //      soit "description", "telephone", "email" sont settés
            if (!empty($_POST['nom'])){
		$valid = $validator->validate($_POST, [
                    'nom' => ['required', 'alpha'],
                ]);
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
                ]);
            }

	    $entreprise = new Entreprise();
	    $results = $entreprise->search($filters);
	    print_r($results);

            // TODO : appel modèle avec filtre
            //$results=[];
	    // remplit $results avec le résultat de la sgbd
            return $this->render('entreprise/recherche', [
		'errors' => null,
		'filters' => $filters,
                'results' => $results,
            ]);
        }

        $this->render('entreprise/recherche');
    }

    public function show($id)
    {
    	$entrepriseModel = new Entreprise();
    	$entreprise = $entrepriseModel->findById($id);

    	if (!$entreprise) {
            http_response_code(404);
            die("Entreprise not found");
    	}

    	$this->render('entreprise/show', [
            'entreprise' => $entreprise
    	]);
    }
}
?>
