<?php

/**
 * Classe de base des contrôleurs.
 * 
 * Fournit des méthodes utilitaires communes à tous les contrôleurs :
 * - Rendu des vues
 * - Redirections HTTP
 */
class Controller
{
    /**
     * Rend une vue avec des données.
     *
     * Délègue le rendu à la classe View en lui passant
     * le nom de la vue ainsi que les données associées.
     *
     * @param string $view Nom de la vue (ex: 'home/index')
     * @param array $data Données à transmettre à la vue
     * 
     * @return void
     */
    protected function render($view, $data = [])
    {
        View::render($view, $data);
    }

    /**
     * Effectue une redirection HTTP.
     *
     * Envoie un header Location puis termine l'exécution du script.
     *
     * @param string $url URL de destination
     * 
     * @return void
     */
    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}