<?php

namespace application\models;

use application\core\Model;

class Account extends Model
{
    public function login($login, $password)
    {
        $result = $this->db->row(
            "SELECT `id`
               FROM `users`
              WHERE `login` = :login
                AND `password` = :password
              LIMIT 1",
            [
                'login' => $login,
                'password' => $password
            ]
        );

        return $result;
    }
}
