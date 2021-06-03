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
        $this::render('login');

    }

    public function process_login()
    {
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            header('Location: ../login.php');
            die();
        }

        $identifiant = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if (empty($identifiant) || empty($password)) {
            header('Location:' . SITE . '/User/login');
            die();
        }

        if (!$this->_user_model->validate($identifiant, hash('sha512', $password))) {
            header('Location:' . SITE . '/User/login');
            die();
        }

        echo 'Connected !';
    }
}
