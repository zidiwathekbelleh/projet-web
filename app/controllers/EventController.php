<?php

class EventController extends Controller
{
    private $eventModel;

    public function __construct()
    {
        $this->eventModel = new Event();
    }

    public function index()
    {
        $events = $this->eventModel->getAll();
        $this->view('admin/events/index', ['events' => $events]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'location' => $_POST['location'],
                'max_participants' => $_POST['max_participants'],
                'created_by' => 2 // à remplacer par $_SESSION['user_id'] si auth
            ];
            $this->eventModel->create($data);
            header('Location: ' . BASE_URL . '/event/index');
            exit;
        }

        $this->view('admin/events/create');
    }

    public function edit($id)
    {
        $event = $this->eventModel->getById($id);
        if (!$event) {
            echo "<div class='alert alert-danger'>Événement introuvable.</div>";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'location' => $_POST['location'],
                'max_participants' => $_POST['max_participants'],
            ];
            $this->eventModel->update($id, $data);
            header('Location: ' . BASE_URL . '/event/index');
            exit;
        }

        $this->view('admin/events/edit', ['event' => $event]);
    }

    public function delete($id)
    {
        $this->eventModel->delete($id);
        header('Location: ' . BASE_URL . '/event/index');
        exit;
    }
}
