<?php

class User extends Model
{
    // 🔄 Récupérer tous les utilisateurs
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM users ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔍 Récupérer un utilisateur par ID
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔍 Récupérer un utilisateur par email (auth)
    public function getByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ➕ Créer un utilisateur
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (email, password, role, full_name)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['email'],
            $data['password'], // déjà hashé depuis le contrôleur
            $data['role'],
            $data['full_name']
        ]);
    }

    // ✏️ Modifier un utilisateur
    public function update($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE users
            SET email = ?, role = ?, full_name = ?, updated_at = NOW()
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['email'],
            $data['role'],
            $data['full_name'],
            $id
        ]);
    }

    // 🗑 Supprimer un utilisateur
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
