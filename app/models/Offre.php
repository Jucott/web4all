<?php

/**
 * Modèle pour la table "offre".
 *
 * Fournit les opérations CRUD via Model et une méthode de recherche paginée.
 */
class Offre extends Model
{
    /** @var string Nom de la table */
    protected string $table = 'offre';

    /** @var string Clé primaire */
    protected string $primaryKey = 'id_offre';

    /**
     * Recherche des offres selon des filtres et pagine les résultats.
     *
     * @param array $filters Tableau clé => valeur pour filtrer 
     * @param int $page Page courante (>=1)
     * @param int $perPage Nombre d'enregistrements par page
     * @return array ['results' => array, 'total' => int]
     */
    public function search(array $filters, int $page = 1, int $perPage = 3): array
    {
        $params = [];
        if (!empty($filters['titre'])) {
            $params[] = ['titre', $filters['titre'], 'ILIKE'];
        }

        if (!empty($filters['description'])) {
            $params[] = ['description', $filters['description'], 'ILIKE'];
        }

        if (!empty($filters['remuneration'])) {
            $params[] = ['remuneration', $filters['remuneration'] * 0.9, '>='];
        }

        if (empty($filters['date_offre'])){
            $params[] = ['date_offre', $filters['date_offre'], '>='];
        }
        
        if (is_bool($filters['valide'])) {
            $params[] = ['valide', $filters['valide'], '='];
        }
        
        // Compte le nombre de résulat pour la requête selective en cours
        $total = $this->count($params);
        
        // Pagination
        $offset = ($page - 1) * $perPage;
        $limit_offset['limit']    = (int)($perPage);
        $limit_offset['offset']   = (int)($offset);
        
        // Requete de recherche
        return [
            'results' => $this->findBy($params, 'titre ASC', $limit_offset),
            'total' => $total
        ];
    }




}