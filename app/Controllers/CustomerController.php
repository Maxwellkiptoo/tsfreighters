<?php
// app/Controllers/CustomerController.php
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/Customer.php';
Auth::init();

class CustomerController
{
    private $model;

    public function __construct()
    {
        $this->model = new Customer();
    }

    public function index()
    {
        Auth::requireLogin();
        // allow managers/admins to see all; customers role might be restricted in real app
        $q = $_GET['q'] ?? null;
        if ($q) {
            $customers = $this->model->search($q);
        } else {
            $customers = $this->model->getAll();
        }
        include __DIR__ . '/../Views/customers/index.php';
    }

    public function create()
    {
        Auth::requireLogin();
        Auth::requireRole(['admin','manager']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Auth::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die('CSRF token invalid');
            }
            // basic server-side validation
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            if ($name === '' || $email === '' || $phone === '') {
                $error = 'Name, Email and Phone are required.';
                include __DIR__ . '/../Views/customers/create.php';
                return;
            }

            $this->model->create($_POST);
            header('Location: index.php?controller=customer&action=index');
            exit;
        }

        include __DIR__ . '/../Views/customers/create.php';
    }

    public function edit()
    {
        Auth::requireLogin();
        Auth::requireRole(['admin','manager']);

        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?controller=customer&action=index'); exit; }

        $customer = $this->model->find($id);
        if (!$customer) { echo "Customer not found"; exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Auth::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die('CSRF token invalid');
            }
            $this->model->update($id, $_POST);
            header('Location: index.php?controller=customer&action=index');
            exit;
        }

        include __DIR__ . '/../Views/customers/edit.php';
    }

    public function view()
    {
        Auth::requireLogin();
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?controller=customer&action=index'); exit; }
        $customer = $this->model->find($id);
        if (!$customer) { echo "Customer not found"; exit; }
        include __DIR__ . '/../Views/customers/view.php';
    }

    public function delete()
    {
        Auth::requireLogin();
        Auth::requireRole(['admin','manager']);
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
        }
        header('Location: index.php?controller=customer&action=index');
        exit;
    }
}
