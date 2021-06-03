<?php

require_once ROOT . '/Controllers/Controller.php';

class AppController extends Controller
{

    public function default()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . SITE . 'User/login');
        }

        $this->render('main', ['user_id' => $_SESSION['user']['id']]);
    }
}
