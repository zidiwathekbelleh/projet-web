<?php
class UserController extends Controller
{
    public function __construct()
    {
        $this->requireRole(['superadmin', 'admin']);
    }

    public function index()
    {
        $userModel = new User();
        $users = $userModel->getAll();
        $this->render('admin/users/index', ['users' => $users]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $userModel->create($_POST);
            header('Location: ' . BASE_URL . '/user/index');
            exit;
        }
        $this->render('admin/users/create');
    }

    public function edit($id)
    {
        $userModel = new User();
        $user = $userModel->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel->update($id, $_POST);
            header('Location: ' . BASE_URL . '/user/index');
            exit;
        }

        $this->render('admin/users/edit', ['user' => $user]);
    }

    public function delete($id)
    {
        $userModel = new User();
        $userModel->delete($id);
        header('Location: ' . BASE_URL . '/user/index');
        exit;
    }
}
