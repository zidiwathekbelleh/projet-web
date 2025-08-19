<?php
require_once dirname(__DIR__) . '/models/Participation.php';

class ParticipationController extends Controller
{
    private Participation $model;

    public function __construct()
    {
        $this->requireRole(['superadmin', 'admin', 'organizer']);
        $this->model = new Participation();
    }

    // 🔹 Liste
    public function index()
    {
        $participations = $this->model->getAll();
        $this->view('admin/participations/index', ['participations' => $participations]);
    }

    // 🔹 Formulaire création
    public function create()
    {
        $users = $this->model->getUsers();
        $events = $this->model->getEvents();
        $this->view('admin/participations/create', ['users' => $users, 'events' => $events]);
    }

    // 🔹 Enregistrer
    public function store()
    {
        if ($_POST) {
            $this->model->create($_POST);
            $this->redirect('participation/index');
        }
    }

    // 🔹 Formulaire édition
    public function edit(int $id)
    {
        $participation = $this->model->getById($id);
        $users = $this->model->getUsers();
        $events = $this->model->getEvents();
        $this->view('admin/participations/edit', ['participation' => $participation, 'users' => $users, 'events' => $events]);
    }

    // 🔹 Mettre à jour
    public function update(int $id)
    {
        if ($_POST) {
            $this->model->update($id, $_POST);
            $this->redirect('participation/index');
        }
    }

    // 🔹 Supprimer
    public function delete(int $id)
    {
        $this->model->delete($id);
        $this->redirect('participation/index');
    }
}
