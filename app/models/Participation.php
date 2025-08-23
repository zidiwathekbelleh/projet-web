<?php
require_once dirname(__DIR__) . '/core/Model.php';

class Participation extends Model
{
    public function __construct() {
        parent::__construct();
    }

    // 🔹 Récupérer toutes les participations
    public function getAll(): array {
        $stmt = $this->db->prepare("
            SELECT p.*, u.full_name AS user_name, e.title AS event_title
            FROM participations p
            JOIN users u ON p.user_id = u.id
            JOIN events e ON p.event_id = e.id
            ORDER BY p.id ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Récupérer par ID
    public function getById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM participations WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Vérifier doublon (même utilisateur pour le même événement)
    public function getByUserEvent(int $user_id, int $event_id): array|false {
        $stmt = $this->db->prepare(
            "SELECT * FROM participations WHERE user_id = :user_id AND event_id = :event_id"
        );
        $stmt->execute([
            'user_id' => $user_id,
            'event_id' => $event_id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Créer une participation
    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO participations (user_id, event_id, status) VALUES (:user_id, :event_id, :status)"
        );
        return $stmt->execute([
            'user_id' => $data['user_id'],
            'event_id' => $data['event_id'],
            'status' => $data['status'] ?? 'pending'
        ]);
    }

    // 🔹 Mettre à jour une participation
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare(
            "UPDATE participations SET user_id = :user_id, event_id = :event_id, status = :status WHERE id = :id"
        );
        return $stmt->execute([
            'id' => $id,
            'user_id' => $data['user_id'],
            'event_id' => $data['event_id'],
            'status' => $data['status'] ?? 'pending'
        ]);
    }

    // 🔹 Supprimer une participation
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM participations WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}