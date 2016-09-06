<?php

namespace Models;


class User
{
    public $id;

    public $firstName;
    public $secondName;
    public $thirdName;

    public $login;
    public $passwordHash;

    public static function getUser($login, $password)
    {

        if (true){
            $result = new User();
            $result->id = 1;
        } else {
            $result = null;
        }


        return $result;
    }
}