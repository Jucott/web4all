<?php

/**
 * Classe abstraite de base pour les modèles.
 *
 * Fournit des méthodes CRUD génériques pour interagir avec la base de données.
 * Chaque modèle concret doit définir :
 * - $table : nom de la table
 * - $primaryKey : clé primaire
 */
abstract class Model
{
    /** @var PDO Instance de connexion PDO */
    protected PDO $db;

    /** @var string Nom de la table */
    protected string $table;

    /** @var string Clé primaire */
    protected string $primaryKey;

    /**
     * Constructeur.
     *
     * Initialise la connexion à la base de données via Database singleton.
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Retourne tous les enregistrements de la table.
     *
     * @return array Liste des enregistrements
     */
    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    /**
     * Trouve un enregistrement par sa clé primaire.
     *
     * @param mixed $id Valeur de la clé primaire
     * @return array|null Enregistrement ou null si non trouvé
     */
    public function findById($id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Trouve des enregistrements selon des critères.
     *
     * @param array $criteria Tableau clé => valeur (ex: ['nom' => 'ABC'])
     * @param string $order chaine de caractere contenant les critère d'ORDER BY (ex: 'nom ASC')
     * @param array $limit_offset Tableau clé => valeur (ex: ['limit' => 3, 'offset' => 0]
     * @return array Liste des enregistrements correspondants
     */
    public function findBy(array $criteria, $order = "", array $limit_offset): array
    {
        $where = implode(' AND ', array_map(fn($k) => "$k = :$k", array_keys($criteria)));
        $sql = "SELECT * FROM {$this->table} WHERE $where ";
        if (!empty($order)){
            $sql .= "ORDER BY $order ";
        }
        if (!empty($limit_offset)){
            foreach ($limit_offset as $key => $value) {
                $sql .= " $key :$key ";
                $criteria[$key] = $value;
            }
        }
        
        $stmt = $this->db->prepare($sql);

        // Liaison des paramètres pour recherche ILIKE
        foreach ($criteria as $key => $value) {
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
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Compte le nombre d'enregistrements correspondant à certains critères.
     *
     * @param array $criteria Tableau clé => valeur facultatif
     * @return int Nombre d'enregistrements correspondants
     */
    public function count(array $criteria = []): int
    {
        if (empty($criteria)) {
            $stmt = $this->db->query("SELECT COUNT(*) FROM {$this->table}");
            return (int) $stmt->fetchColumn();
        }

        $where = implode(' AND ', array_map(fn($k) => "$k = :$k", array_keys($criteria)));
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE $where");
        // Liaison des paramètres pour recherche ILIKE
        foreach ($criteria as $key => $value) {
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
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * Vérifie si un enregistrement existe par sa clé primaire.
     *
     * @param mixed $id Valeur de la clé primaire
     * @return bool True si l'enregistrement existe, false sinon
     */
    public function exists($id): bool
    {
        $stmt = $this->db->prepare(
            "SELECT 1 FROM {$this->table} WHERE {$this->primaryKey} = :id"
        );
        $stmt->execute(['id' => $id]);
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Crée un nouvel enregistrement.
     *
     * @param array $data Tableau clé => valeur des colonnes
     * @return bool True si succès, false sinon
     */
    public function create(array $data): bool
    {
        $columns = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }

    /**
     * Met à jour un enregistrement existant.
     *
     * @param mixed $id Clé primaire de l'enregistrement
     * @param array $data Données à mettre à jour
     * @return bool True si succès, false sinon
     */
    public function update($id, array $data): bool
    {

        $set = implode(',', array_map(fn($k) => "$k = :$k", array_keys($data)));
        $data[$this->primaryKey] = $id;

        $sql = "UPDATE {$this->table} SET $set
                WHERE {$this->primaryKey} = :{$this->primaryKey}";
        //var_dump($sql); var_dump($data); exit;
        $stmt = $this->db->prepare($sql);
        foreach ($data as $key => $value) {
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
        return $stmt->execute();
    }

    /**
     * Supprime un enregistrement par sa clé primaire.
     *
     * @param mixed $id Clé primaire de l'enregistrement
     * @return bool True si succès, false sinon
     */
    public function delete($id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table}
             WHERE {$this->primaryKey} = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}