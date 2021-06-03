<?php

require_once ROOT . '/core/DBconnexion.php';

class Model
{
    protected $_conn;

    public function __construct()
    {
        $this->_conn = DBConnexion::getInstance();
    }
}