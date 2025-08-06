<?php

class User extends Model
{
    protected $table = 'users';

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO users (email, password, role, full_name) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['email'], $data['password'], $data['role'], $data['full_name']]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE users SET email = ?, role = ?, full_name = ? WHERE id = ?");
        return $stmt->execute([$data['email'], $data['role'], $data['full_name'], $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
