<?php

require_once ROOT . '/Models/Model.php';

class UserModel extends Model
{
    public function validate($uid, $authentication_string): ?int
    {
        $query = '
            select id 
            from users 
            where uid = :uid
            and authentication_string = :authentication_string
        ';

        return $this->_conn->execute(
            $query, ['uid' => $uid, 'authentication_string' => $authentication_string]
        )->fetch()['id'] ?: null;
    }
}