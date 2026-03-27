<?php

/**
 * Gestionnaire de rendu des vues.
 *
 * Permet de séparer le layout principal et le contenu des vues spécifiques,
 * et fournit un helper pour la pagination.
 */
class View
{
    /**
     * Rend une vue avec un layout.
     *
     * @param string $view Nom de la vue relative à /views (ex: 'home/index')
     * @param array $data Données à passer à la vue (variables disponibles via extract)
     * @return void
     */
    public static function render(string $view, array $data = []): void
    {
        $data['title']          = 'Web4All';
        $data['description']    = 'Site Web pour trouver des entreprises et stages';
        $data['robots']         = 'index,follow';
        // Extraction des variables pour la vue
        extract($data, EXTR_SKIP);

        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die("Vue introuvable : " . htmlspecialchars($view));
        }

        // Capture du contenu spécifique de la vue
        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        // Chargement du layout principal
        $layoutPath = __DIR__ . '/../views/layout.php';
        if (!file_exists($layoutPath)) {
            die("Layout introuvable");
        }

        require $layoutPath;
    }

    /**
     * Construit un tableau de pagination pour affichage.
     *
     * Exemple : [1, "...", 8, 9, 10, 11, 12, "...", 50]
     *
     * @param int $currentPage Page courante
     * @param int $totalPages  Nombre total de pages
     * @param int $window      Nombre de pages visibles autour de la page courante
     * @return array Tableau de pages / ellipses
     */
    public static function buildPagination(int $currentPage, int $totalPages, int $window = 2): array
    {
        $pages = [];

        if ($totalPages < 1) {
            return $pages;
        }

        $pages[] = 1;

        $start = max(2, $currentPage - $window);
        $end = min($totalPages - 1, $currentPage + $window);

        if ($start > 2) {
            $pages[] = '...';
        }

        for ($i = $start; $i <= $end; $i++) {
            $pages[] = $i;
        }

        if ($end < $totalPages - 1) {
            $pages[] = '...';
        }

        if ($totalPages > 1) {
            $pages[] = $totalPages;
        }

        return $pages;
    }

    public static function Dumper($data): void 
    {
        echo '<pre>' . print_r($data, true) . '</pre>';
    }


    public static function button(array $config): void
    {
        $roleId = Auth::roleId();    
        if (!Auth::can($config['permission'], $roleId)) {
            return;
        }

        // URL
        $url = $config['url'] ?? '#';
        $fullUrl = ($url === '#') ? '#' : (CDN . PREFIX . $url);

        // classes
        $class = 'btn-icon ' . ($config['class'] ?? '');

        // attributs dynamiques
        $attributes = '';

        if (!empty($config['attributes']) && is_array($config['attributes'])) {
            foreach ($config['attributes'] as $key => $value) {
                $attributes .= sprintf(' %s="%s"', $key, htmlspecialchars($value));
            }
        }

        // title
        if (!empty($config['title'])) {
            $attributes .= ' title="'.htmlspecialchars($config['title']).'"';
            $attributes .= ' data-tooltip="'.htmlspecialchars($config['title']).'"';
        }

        // contenu
        $content = $config['icon'] ?? '';

        echo sprintf(
            '<a href="%s" class="%s"%s>%s</a>',
            $fullUrl,
            $class,
            $attributes,
            $content
        );
    }
}