<?php

require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_URI'] === '/home') {
            $this->redirect('/');
        }

        $this->render('home/index');
    }
}