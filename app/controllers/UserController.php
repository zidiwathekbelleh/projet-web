<?php
require_once dirname(__DIR__) . '/models/User.php';

class UserController extends Controller
{
    private User $userModel;

    public function __construct() {
        $this->requireRole(['superadmin', 'admin']);
        $this->userModel = new User();
    }

    // 🔹 Liste des utilisateurs
    public function index() {
        $users = $this->userModel->getAll();
        $this->view('admin/users/index', ['users' => $users]);
    }

    // 🔹 Formulaire création
    public function create() {
        $this->view('admin/users/create');
    }

    // 🔹 Enregistrement nouvel utilisateur
    public function store() {
        if ($_POST) {
            $this->userModel->create($_POST);
            $this->redirect('user/index'); // <-- corrigé
        }
    }

    // 🔹 Formulaire édition
    public function edit(int $id) {
        $user = $this->userModel->getById($id);
        $this->view('admin/users/edit', ['user' => $user]);
    }

    // 🔹 Mettre à jour utilisateur
    public function update(int $id) {
        if ($_POST) {
            $this->userModel->update($id, $_POST);
            $this->redirect('user/index'); // <-- corrigé
        }
    }

    // 🔹 Supprimer utilisateur
    public function delete(int $id) {
        $this->userModel->delete($id);
        $this->redirect('user/index'); // <-- corrigé
    }
}
