<?php
require_once dirname(__DIR__) . '/core/Model.php';

class Participation extends Model
{
    protected string $table = 'participations';

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT p.*, u.full_name AS user_name, e.title AS event_title
                                  FROM participations p
                                  JOIN users u ON p.user_id = u.id
                                  JOIN events e ON p.event_id = e.id
                                  ORDER BY p.id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM participations WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare("INSERT INTO participations (user_id, event_id, status) VALUES (:user_id, :event_id, :status)");
        $stmt->execute([
            'user_id' => $data['user_id'],
            'event_id' => $data['event_id'],
            'status' => $data['status'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare("UPDATE participations SET user_id=:user_id, event_id=:event_id, status=:status WHERE id=:id");
        $stmt->execute([
            'id' => $id,
            'user_id' => $data['user_id'],
            'event_id' => $data['event_id'],
            'status' => $data['status'],
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM participations WHERE id=:id");
        $stmt->execute(['id' => $id]);
    }

    public function getUsers(): array
    {
        $stmt = $this->db->query("SELECT id, full_name FROM users ORDER BY full_name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEvents(): array
    {
        $stmt = $this->db->query("SELECT id, title FROM events ORDER BY start_date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
