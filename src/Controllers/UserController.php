<?php

require_once ROOT . '/Controllers/Controller.php';

class UserController extends Controller
{
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
            header('Location: ../login.php?error=unset');
            die();
        }

        $identifiant = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if (empty($identifiant) || empty($password)) {
            header('Location: ../login.php?error=empty');
            die();
        }
    }
}
