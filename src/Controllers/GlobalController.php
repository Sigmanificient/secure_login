<?php

require_once ROOT . '/Controllers/Controller.php';

class GlobalController extends Controller
{

    public function default()
    {
        $this->render('landing');
    }
}
