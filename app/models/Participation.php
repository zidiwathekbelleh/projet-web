<?php

class Participation extends Model
{
    public function getAll()
    {
        $stmt = $this->db->query("
            SELECT p.*, u.full_name AS user_name, e.title AS event_title
            FROM participations p
            JOIN users u ON p.user_id = u.id
            JOIN events e ON p.event_id = e.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM participations WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO participations (user_id, event_id, status)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$data['user_id'], $data['event_id'], $data['status']]);
    }

    public function update($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE participations SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM participations WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAllUsers()
    {
        return $this->db->query("SELECT id, full_name FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEvents()
    {
        return $this->db->query("SELECT id, title FROM events")->fetchAll(PDO::FETCH_ASSOC);
    }
}
