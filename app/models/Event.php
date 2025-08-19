<?php
require_once APP . '/core/Model.php';

class Event extends Model
{
    /**
     * Obtenir tous les événements
     * @return array
     */
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT e.*, u.full_name AS creator_name 
                                  FROM events e 
                                  LEFT JOIN users u ON e.created_by = u.id
                                  ORDER BY e.start_date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtenir un événement par ID
     */
    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $event = $stmt->fetch(PDO::FETCH_ASSOC);
        return $event ?: null;
    }

    /**
     * Créer un événement
     */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO events (title, description, start_date, end_date, location, created_by)
             VALUES (:title, :description, :start_date, :end_date, :location, :created_by)"
        );
        return $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'location' => $data['location'],
            'created_by' => $data['created_by'] // Doit être l'ID utilisateur connecté
        ]);
    }

    /**
     * Mettre à jour un événement
     */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE events SET title = :title, description = :description, start_date = :start_date, 
             end_date = :end_date, location = :location WHERE id = :id"
        );
        return $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'location' => $data['location'],
            'id' => $id
        ]);
    }

    /**
     * Supprimer un événement
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
