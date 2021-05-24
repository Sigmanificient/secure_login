<?php

try {
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    # This user & password are placeholders and NEED to be changed

    $connexion = new PDO(
        'mysql:host=127.0.0.1;dbname=secure_login', 'secure_login',
        'Xd0q8.L%a9w~k21Mm*j+4fV_3a1-!Oi6',
        $options
    );

}
catch (PDOException $error) {
    echo 'Erreur : '.$error->getMessage();
}
