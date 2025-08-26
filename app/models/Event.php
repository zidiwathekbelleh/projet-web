<?php
require_once APP . '/core/Model.php';
require_once dirname(__DIR__, 2) . '/vendor/autoload.php'; // Composer Autoload

use Dompdf\Dompdf;

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
            'created_by' => $data['created_by']
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

    /**
     * Exporter tous les événements en PDF avec Dompdf
     */
    public function exportPdf()
    {
        $events = $this->getAll();

        $html = '<h1 style="text-align: center; color: #4e73df;">Liste des événements</h1>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">';
        $html .= '<tr style="background-color: #4e73df; color: white;">
                    <th>ID</th><th>Titre</th><th>Date début</th><th>Date fin</th><th>Lieu</th><th>Créateur</th>
                  </tr>';

        foreach ($events as $e) {
            $html .= '<tr>';
            $html .= '<td>' . $e['id'] . '</td>';
            $html .= '<td>' . htmlspecialchars($e['title']) . '</td>';
            $html .= '<td>' . $e['start_date'] . '</td>';
            $html .= '<td>' . $e['end_date'] . '</td>';
            $html .= '<td>' . htmlspecialchars($e['location']) . '</td>';
            $html .= '<td>' . htmlspecialchars($e['creator_name']) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('evenements.pdf', ['Attachment' => false]);
        exit;
    }

    /**
     * Exporter les événements en CSV
     */
    public function exportCsv()
    {
        $events = $this->getAll();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="evenements.csv"');

        $output = fopen('php://output', 'w');
        
        // En-têtes CSV
        fputcsv($output, ['ID', 'Titre', 'Description', 'Date début', 'Date fin', 'Lieu', 'Créateur'], ';');
        
        // Données
        foreach ($events as $e) {
            fputcsv($output, [
                $e['id'],
                $e['title'],
                $e['description'],
                $e['start_date'],
                $e['end_date'],
                $e['location'],
                $e['creator_name']
            ], ';');
        }

        fclose($output);
        exit;
    }
}
