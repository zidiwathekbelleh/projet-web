<?php

class Participation extends Model
{
    /**
     * 📋 Obtenir toutes les participations avec noms utilisateur et titre événement
     */
    public function getAll()
    {
        $stmt = $this->db->query("
            SELECT p.*, u.full_name AS user_name, e.title AS event_title
            FROM participations p
            JOIN users u ON p.user_id = u.id
            JOIN events e ON p.event_id = e.id
            ORDER BY p.registration_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 🔍 Récupérer une participation par ID
     */
    public function getById($id)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, u.full_name AS user_name, e.title AS event_title
            FROM participations p
            JOIN users u ON p.user_id = u.id
            JOIN events e ON p.event_id = e.id
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 🛡 Vérifier si une participation existe déjà (éviter doublons)
     */
    public function getByUserAndEvent($userId, $eventId)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM participations
            WHERE user_id = ? AND event_id = ?
        ");
        $stmt->execute([$userId, $eventId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * ➕ Créer une nouvelle participation
     */
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO participations (user_id, event_id, status)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([
            $data['user_id'],
            $data['event_id'],
            $data['status']
        ]);
    }

    /**
     * ✏️ Mettre à jour le statut
     */
    public function update($id, $status)
    {
        $stmt = $this->db->prepare("
            UPDATE participations 
            SET status = ?, registration_date = NOW()
            WHERE id = ?
        ");
        return $stmt->execute([$status, $id]);
    }

    /**
     * 🗑 Supprimer une participation
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM participations WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * 📋 Obtenir tous les utilisateurs (pour menus déroulants)
     */
    public function getAllUsers()
    {
        $stmt = $this->db->query("
            SELECT id, full_name 
            FROM users 
            ORDER BY full_name ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 📋 Obtenir tous les événements (pour menus déroulants)
     */
    public function getAllEvents()
    {
        $stmt = $this->db->query("
            SELECT id, title 
            FROM events 
            ORDER BY start_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
