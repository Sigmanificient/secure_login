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
}
