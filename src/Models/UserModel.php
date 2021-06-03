<?php

require_once ROOT . '/Models/Model.php';

class UserModel extends Model
{
    public function validate($uid, $authentication_string): bool
    {
        $query = '
            select 1
            from users 
            where uid = :uid
            and authentication_string = :authentication_string
        ';

        $result = $this->_conn->execute(
            $query, ['uid' => $uid, 'authentication_string' => $authentication_string]
        )->fetch();

        return !is_bool($result);
    }

    public function get_by_uid($uid)
    {
        $query = '
            select id
            from users 
            where uid = :uid
        ';

        $result = $this->_conn->execute($query, ['uid' => $uid])->fetch();
        return $result['id'] ?? null;
    }
}