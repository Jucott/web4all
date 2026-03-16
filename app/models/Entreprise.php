<?php

class Entreprise extends Model
{
    protected string $table = 'entreprise';
    protected string $primaryKey = 'id_entreprise';

    
    public function search(array $filters, int $page = 1, int $perPage = 3): array
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

        $where = '';

        if ($conditions) {
            $where = " WHERE " . implode(" AND ", $conditions);
        }

        // COUNT total
        $sqlCount = "SELECT COUNT(*) FROM {$this->table} $where";
        $stmt = $this->db->prepare($sqlCount);
        $stmt->execute($params);
        $total = (int) $stmt->fetchColumn();

        // pagination
        $offset = ($page - 1) * $perPage;

        $sql = "SELECT * FROM {$this->table} $where
                ORDER BY nom
                LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return [
            'results' => $stmt->fetchAll(),
            'total' => $total
        ];
    }
}
