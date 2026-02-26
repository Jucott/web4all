<?php

abstract class Model
{
    protected PDO $db;
    protected string $table;
    protected string $primaryKey;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function findById($id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $columns = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }

    public function update($id, array $data): bool
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key,";
        }
        $set = rtrim($set, ',');

        $data[$this->primaryKey] = $id;

        $sql = "UPDATE {$this->table} SET $set
                WHERE {$this->primaryKey} = :{$this->primaryKey}";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table}
             WHERE {$this->primaryKey} = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}
