<?php

/**
 * Modèle pour la table "entreprise".
 *
 * Fournit les opérations CRUD via Model et une méthode de recherche paginée.
 */
class Entreprise extends Model
{
    /** @var string Nom de la table */
    protected string $table = 'entreprise';

    /** @var string Clé primaire */
    protected string $primaryKey = 'id_entreprise';

    /**
     * Recherche des entreprises selon des filtres et pagine les résultats.
     *
     * @param array $filters Tableau clé => valeur pour filtrer (nom, description, telephone, email)
     * @param int $page Page courante (>=1)
     * @param int $perPage Nombre d'enregistrements par page
     * @return array ['results' => array, 'total' => int]
     */
    public function search(array $filters, int $page = 1, int $perPage = 3): array
    {
        $conditions = [];
        $params = [];
        if (!empty($filters['nom'])) {
            $conditions[] = "nom ILIKE :nom";
            $params['nom'] = "%" . $filters['nom'] . "%";
        }

        if (!empty($filters['description'])) {
            $conditions[] = "description ILIKE :description";
            $params['description'] = "%" . $filters['description'] . "%";
        }

        if (!empty($filters['telephone'])) {
            $conditions[] = "telephone ILIKE :telephone";
            $params['telephone'] = "%" . $filters['telephone'] . "%";
        }

        if (!empty($filters['email'])) {
            $conditions[] = "email ILIKE :email";
            $params['email'] = "%" . $filters['email'] . "%";
        }

        if (is_bool($filters['valide'])) {
            $conditions[] = "valide = :valide";
            $params['valide'] = $filters['valide'];
        }
        $where = $conditions ? " WHERE " . implode(" AND ", $conditions) : "";

        $total = $this->count($params);

        // Pagination
        $offset = ($page - 1) * $perPage;

        $sql = "SELECT * FROM {$this->table} $where
                ORDER BY nom
                LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        // Liaison des paramètres pour recherche ILIKE
        foreach ($params as $key => $value) {
            if (is_bool($value)) {
                $stmt->bindValue(":$key", $value, PDO::PARAM_BOOL);
            } elseif (is_int($value)) {
                $stmt->bindValue(":$key", $value, PDO::PARAM_INT);
            } elseif (is_null($value)) {
                $stmt->bindValue(":$key", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
            }
        }

        // Liaison des paramètres de pagination
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return [
            'results' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'total' => $total
        ];
    }
}