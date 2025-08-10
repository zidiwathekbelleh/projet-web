<?php
// app/controllers/AdminController.php

class AdminController extends Controller
{
    public function __construct()
    {
        $this->requireRole(['superadmin', 'admin']);
    }

    public function dashboard()
    {
        $db = new Database();
        $pdo = $db->getConnection();

        // Statistiques rapides
        $stats = [
            'total_users' => (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            'total_events' => (int)$pdo->query("SELECT COUNT(*) FROM events")->fetchColumn(),
            'total_participations' => (int)$pdo->query("SELECT COUNT(*) FROM participations")->fetchColumn(),
            'roles_distribution' => $this->getRolesDistribution($pdo),
            'events_per_month' => $this->getEventsPerMonth($pdo),
            'participations_status' => $this->getParticipationStatus($pdo)
        ];

        // Rendre la vue (layout inside the view)
        $this->render('admin/dashboard', ['stats' => $stats]);
    }

    private function getRolesDistribution($pdo)
    {
        $out = [];
        $stmt = $pdo->query("SELECT role, COUNT(*) AS cnt FROM users GROUP BY role");
        while ($r = $stmt->fetch()) $out[$r['role']] = (int)$r['cnt'];
        return $out;
    }

    private function getEventsPerMonth($pdo)
    {
        $out = [];
        $stmt = $pdo->query("SELECT DATE_FORMAT(start_date, '%Y-%m') AS month, COUNT(*) AS cnt FROM events GROUP BY month ORDER BY month");
        while ($r = $stmt->fetch()) $out[$r['month']] = (int)$r['cnt'];
        return $out;
    }

    private function getParticipationStatus($pdo)
    {
        $out = [];
        $stmt = $pdo->query("SELECT status, COUNT(*) AS cnt FROM participations GROUP BY status");
        while ($r = $stmt->fetch()) $out[$r['status']] = (int)$r['cnt'];
        return $out;
    }
}
