<?php

require_once ROOT . '/Core/Singleton.php';

class DBConnexion extends Singleton
{
    private $__conf_path = ROOT . '/Core/db.ini';

    private $_host = "localhost";
    /* localhost or DBServer IP. If you using a remote server, make sure to only accept critical ip and not 0.0.0.0 */

    private $_dbname = "secure_login";
    private $_dbuser = "secure_login";
    /* Make sure that the application have it own user and minimal permission on the database */

    private $_dbpassword = "SfbDE24GMA_ikXa-3EOq-nwNJA_NwEm1";
    /*
    Your DB password should always be 16+ Characters long, having lowercase, uppercase, digits, special symbol.
    If you use UTF-8 in your password, make sure it wont cause issue in the production environment.
    */

    private $_conn;
    private $status;

    protected function __construct()
    {
        try {
            $this->_conn = new PDO(
                'mysql:host=' . $this->_host . ";dbname=" . $this->_dbname . ';charset=utf8',
                $this->_dbuser, $this->_dbpassword
            );

            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            /* set error mode to silent, to avoid leaking information */

            $this->_conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $error) {
            $this->status = $error->getMessage();
        }
    }

    public function execute($sql, $params = []): PDOStatement
    {
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
