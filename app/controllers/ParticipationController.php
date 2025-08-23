<?php
require_once dirname(__DIR__) . '/models/Participation.php';
require_once dirname(__DIR__) . '/models/User.php';
require_once dirname(__DIR__) . '/models/Event.php';
require_once dirname(__DIR__) . '/mailing/Mailer.php'; // chemin corrigé

class ParticipationController
{
    private $participation;
    private $user;
    private $event;
    private $mailer;

    public function __construct()
    {
        $this->participation = new Participation();
        $this->user = new User();
        $this->event = new Event();
        $this->mailer = new Mailer();
    }

    // 🔹 Liste des participations
    public function index()
    {
        $participations = $this->participation->getAll();
        require_once dirname(__DIR__) . '/views/admin/participations/index.php';
    }

    // 🔹 Affichage formulaire création
    public function create()
    {
        $users = $this->user->getAll();
        $events = $this->event->getAll();
        require_once dirname(__DIR__) . '/views/admin/participations/create.php';
    }

    // 🔹 Enregistrer la participation
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_POST['user_id'],
                'event_id' => $_POST['event_id'],
                'status' => $_POST['status'] ?? 'pending'
            ];

            // Vérifier la contrainte unique (éviter duplicate entry)
            $existing = $this->participation->getByUserEvent($data['user_id'], $data['event_id']);
            if ($existing) {
                die("Erreur : cette participation existe déjà !");
            }

            $result = $this->participation->create($data);

            if ($result) {
                $event = $this->event->getById($data['event_id']);

                // Envoi mail à ton adresse fixe
                $subject = "Nouvelle participation";
                $htmlBody = "<p>Nouvelle participation à l'événement : <strong>{$event['title']}</strong></p>";

                $this->mailer->sendToMe($subject, $htmlBody);

                header('Location: /projet-web/public/participations');
                exit;
            } else {
                die("Erreur lors de la création de la participation");
            }
        }
    }

    // 🔹 Affichage formulaire modification
    public function edit($id)
    {
        $participation = $this->participation->getById($id);
        $users = $this->user->getAll();
        $events = $this->event->getAll();
        require_once dirname(__DIR__) . '/views/admin/participations/edit.php';
    }

    // 🔹 Mettre à jour participation
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_POST['user_id'],
                'event_id' => $_POST['event_id'],
                'status' => $_POST['status'] ?? 'pending'
            ];

            $result = $this->participation->update($id, $data);

            if ($result) {
                header('Location: /projet-web/public/participations');
                exit;
            } else {
                die("Erreur lors de la mise à jour de la participation");
            }
        }
    }

    // 🔹 Supprimer participation
    public function delete($id)
    {
        $result = $this->participation->delete($id);
        if ($result) {
            header('Location: /projet-web/public/participations');
            exit;
        } else {
            die("Erreur lors de la suppression");
        }
    }
}
