<?php

class Event extends Model
{
    public function getAll()
    {
        $stmt = $this->db->query("SELECT e.*, u.full_name AS organizer FROM events e JOIN users u ON e.created_by = u.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO events (title, description, start_date, end_date, location, max_participants, created_by)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['title'], $data['description'], $data['start_date'],
            $data['end_date'], $data['location'], $data['max_participants'],
            $data['created_by']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE events SET title = ?, description = ?, start_date = ?, end_date = ?,
            location = ?, max_participants = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['title'], $data['description'], $data['start_date'],
            $data['end_date'], $data['location'], $data['max_participants'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
