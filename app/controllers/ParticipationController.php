<?php

class ParticipationController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->requireRole(['admin', 'organizer', 'participant']);
        $this->model = new Participation();
    }

    // 📋 Lister toutes les participations
    public function index()
    {
        $participations = $this->model->getAll();
        $this->view('admin/participations/index', [
            'participations' => $participations
        ]);
    }

    // ➕ Ajouter une participation
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_POST['user_id'],
                'event_id' => $_POST['event_id'],
                'status' => $_POST['status']
            ];

            // Vérifier si la participation existe déjà
            if ($this->model->getByUserAndEvent($data['user_id'], $data['event_id'])) {
                $_SESSION['flash']['error'] = "⚠️ Cette participation existe déjà.";
                header('Location: ' . BASE_URL . '/participation/create');
                exit;
            }

            $this->model->create($data);
            $_SESSION['flash']['success'] = "✅ Participation ajoutée.";
            header('Location: ' . BASE_URL . '/participation/index');
            exit;
        }

        $users = $this->model->getAllUsers();
        $events = $this->model->getAllEvents();

        $this->view('admin/participations/create', [
            'users' => $users,
            'events' => $events
        ]);
    }

    // ✏️ Modifier le statut
    public function edit($id)
    {
        $participation = $this->model->getById($id);

        if (!$participation) {
            $_SESSION['flash']['error'] = "Participation introuvable.";
            header('Location: ' . BASE_URL . '/participation/index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST['status']);
            $_SESSION['flash']['success'] = "✅ Participation modifiée.";
            header('Location: ' . BASE_URL . '/participation/index');
            exit;
        }

        $this->view('admin/participations/edit', [
            'participation' => $participation
        ]);
    }

    // 🗑 Supprimer
    public function delete($id)
    {
        $this->model->delete($id);
        $_SESSION['flash']['success'] = "🗑 Participation supprimée.";
        header('Location: ' . BASE_URL . '/participation/index');
        exit;
    }
}
