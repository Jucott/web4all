<?php

class View
{
    public static function render($view, $data = [])
    {
        extract($data);

        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die("Vue introuvable : " . $view);
        }

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout.php';
    }


    public static function buildPagination($currentPage, $totalPages, $window = 2)
    {
        $pages = [];

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
        // Renvoi [1, "...", 8, 9, 10, 11, 12, "...", 50]
        return $pages;
    }

}
