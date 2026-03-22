<?php

/**
 * Modèle pour la table "ident".
 *
 * Fournit les opérations CRUD via Model et une méthode de recherche paginée.
 */
class Ident extends Model
{
    /** @var string Nom de la table */
    protected string $table = 'ident';

    /** @var string Clé primaire */
    protected string $primaryKey = 'id_ident';

    /**
     * Recherche des identifiants selon des filtres et pagine les résultats.
     *
     * @param array $filters Tableau clé => valeur pour filtrer (nom, prenom, telephone, email)
     * @param int $page Page courante (>=1)
     * @param int $perPage Nombre d'enregistrements par page
     * @return array ['results' => array, 'total' => int]
     */
    public function search(array $filters, int $page = 1, int $perPage = 3): array
    {
        $params = [];
        if (!empty($filters['nom'])) {
            $params[] = ['nom', $filters['nom'], 'ILIKE'];
        }

        if (!empty($filters['prenom'])) {
            $params[] = ['prenom', $filters['prenom'], 'ILIKE'];
        }

        if (!empty($filters['email'])) {
            $params[] = ['email', $filters['email'], 'ILIKE'];
        }

        if (empty($filters['id_role'])){
            $params[] = ['id_role', Auth::user()['id_role'], '>='];
        }
        elseif (!empty($filters['id_role'])){
            if ((string)($filters['id_role']) >= (string)(Auth::user()['id_role'])) {
                $params[] = ['id_role', $filters['id_role'], '='];
            }
            else {
                $params[] = ['id_role', Auth::user()['id_role'], '>='];
            }
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
            'results' => $this->findBy($params, 'nom ASC', $limit_offset),
            'total' => $total
        ];
    }




}