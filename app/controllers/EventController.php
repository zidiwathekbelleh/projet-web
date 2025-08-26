<?php
require_once dirname(__DIR__, 2) . '/vendor/autoload.php'; // Composer Autoload
require_once APP . '/models/Event.php';

use Dompdf\Dompdf;

class EventController extends Controller
{
    private Event $eventModel;

    public function __construct()
    {
        $this->requireRole(['superadmin', 'admin', 'organizer']);
        $this->eventModel = new Event();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Liste des événements
    public function index()
    {
        $events = $this->eventModel->getAll();
        $this->view('admin/events/index', ['events' => $events]);
    }

    // Formulaire création
    public function create()
    {
        $this->view('admin/events/create');
    }

    // Enregistrement nouvel événement
    public function store()
    {
        if ($_POST) {
            $data = $_POST;
            $data['created_by'] = $_SESSION['user']['id'];
            $this->eventModel->create($data);
            header('Location: ' . BASE_URL . '/event/index');
            exit;
        }
    }

    // Formulaire édition
    public function edit($id)
    {
        $event = $this->eventModel->getById((int)$id);
        $this->view('admin/events/edit', ['event' => $event]);
    }

    // Mettre à jour événement
    public function update($id)
    {
        if ($_POST) {
            $this->eventModel->update((int)$id, $_POST);
            header('Location: ' . BASE_URL . '/event/index');
            exit;
        }
    }

    // Supprimer événement
    public function delete($id)
    {
        $this->eventModel->delete((int)$id);
        header('Location: ' . BASE_URL . '/event/index');
        exit;
    }

    // Export PDF
    public function exportPdf()
    {
        $events = $this->eventModel->getAll();

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
}
