<?php

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $users = $this->userModel->getAll();
        $this->view('admin/users/index', ['users' => $users]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role' => $_POST['role'],
                'full_name' => $_POST['full_name']
            ];
            $this->userModel->create($data);
            header('Location: ' . BASE_URL . '/user/index');
            exit;
        }

        $this->view('admin/users/create');
    }

    public function edit($id)
    {
        $user = $this->userModel->getById($id);

        if (!$user) {
            // Afficher erreur simple
            echo "<div class='container mt-5 alert alert-danger'>❌ Utilisateur introuvable.</div>";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => $_POST['email'],
                'role' => $_POST['role'],
                'full_name' => $_POST['full_name']
            ];
            $this->userModel->update($id, $data);
            header('Location: ' . BASE_URL . '/user/index');
            exit;
        }

        $this->view('admin/users/edit', ['user' => $user]);
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        header('Location: ' . BASE_URL . '/user/index');
        exit;
    }
}
