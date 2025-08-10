<?php

class EventController extends Controller
{
    private $eventModel;

    public function __construct()
    {
        $this->requireRole(['superadmin', 'admin', 'organizer']);
        $this->eventModel = new Event();
    }

    // 📌 Liste des événements
    public function index()
    {
        $events = $this->eventModel->getAll();
        $this->render('admin/events/index', ['events' => $events]);
    }

    // 📌 Formulaire de création
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'location' => trim($_POST['location']),
                'max_participants' => $_POST['max_participants'],
                'created_by' => $_SESSION['user']['id']
            ];

            if ($this->eventModel->create($data)) {
                $this->redirect('event/index');
            } else {
                $error = "Erreur lors de la création de l'événement.";
                $this->render('admin/events/create', ['error' => $error]);
            }
        } else {
            $this->render('admin/events/create');
        }
    }

    // 📌 Édition d’un événement
    public function edit($id)
    {
        $event = $this->eventModel->getById($id);

        if (!$event) {
            $this->redirect('event/index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'location' => trim($_POST['location']),
                'max_participants' => $_POST['max_participants']
            ];

            if ($this->eventModel->update($id, $data)) {
                $this->redirect('event/index');
            } else {
                $error = "Erreur lors de la mise à jour.";
                $this->render('admin/events/edit', ['event' => $event, 'error' => $error]);
            }
        } else {
            $this->render('admin/events/edit', ['event' => $event]);
        }
    }

    // 📌 Suppression d’un événement
    public function delete($id)
    {
        $this->eventModel->delete($id);
        $this->redirect('event/index');
    }
}
