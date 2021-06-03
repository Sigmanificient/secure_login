<?php

require_once ROOT . '/Controllers/Controller.php';
require_once ROOT . '/Models/UserModel.php';

class UserController extends Controller
{
    private $_user_model;

    public function __construct()
    {
        $this->_user_model = new UserModel();
    }

    public function default()
    {
        header('Location: /User/login');
    }

    public function login()
    {
        $error = $_SESSION['error'] ?? false;
        unset($_SESSION['error']);

        $this::render('login', ['error' => $error]);
    }

    public function process_login()
    {
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            $_SESSION['error'] = 'empty';
            header('Location: ../login.php');
            return;
        }

        $identifiant = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if (empty($identifiant) || empty($password)) {
            $_SESSION['error'] = 'empty';
            header('Location:' . SITE . '/User/login');
            return;
        }

        if (!$this->_user_model->validate($identifiant, hash('sha512', $password))) {
            $_SESSION['error'] = 'invalid';
            header('Location:' . SITE . '/User/login');
            return;
        }

        $_SESSION['user'] = ['id' => $this->_user_model->get_by_uid($identifiant)];
        var_dump($_SESSION['user']);
    }
}
