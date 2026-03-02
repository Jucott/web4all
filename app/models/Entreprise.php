<?php

class Entreprise extends Model
{
    protected string $table = 'entreprise';
    protected string $primaryKey = 'id_entreprise';

    
    public function search(array $filters): array
    {
        $conditions = [];
        $params = [];

        if (!empty($filters['nom'])) {
            $conditions[] = "nom ILIKE :nom";
            $params['nom'] = "%".$filters['nom']."%";
        }

        if (!empty($filters['description'])) {
            $conditions[] = "description ILIKE :description";
            $params['description'] = "%".$filters['description']."%";
        }

        if (!empty($filters['telephone'])) {
            $conditions[] = "telephone ILIKE :telephone";
            $params['telephone'] = "%".$filters['telephone']."%";
        }

        if (!empty($filters['email'])) {
            $conditions[] = "email ILIKE :email";
            $params['email'] = "%".$filters['email']."%";
        }

        $sql = "SELECT * FROM {$this->table}";

        if ($conditions) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}
