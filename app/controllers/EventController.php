<?php
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
            $data['created_by'] = $_SESSION['user']['id']; // ID utilisateur connecté
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
}
