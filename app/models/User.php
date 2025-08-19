<?php
require_once dirname(__DIR__) . '/core/Model.php';

class User extends Model
{
    public function __construct() {
        parent::__construct();
    }

    // 🔹 Récupérer tous les utilisateurs
    public function getAll(): array {
        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Récupérer par ID
    public function getById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Récupérer par email
    public function getByEmail(string $email): array|false {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Créer utilisateur
    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO users (full_name, email, password, role) VALUES (:full_name, :email, :password, :role)"
        );
        return $stmt->execute([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $data['role']
        ]);
    }

    // 🔹 Mettre à jour utilisateur
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare(
            "UPDATE users SET full_name = :full_name, email = :email, role = :role WHERE id = :id"
        );
        return $stmt->execute([
            'id' => $id,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'role' => $data['role']
        ]);
    }

    // 🔹 Supprimer utilisateur
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
