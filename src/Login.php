<?php

namespace Everytask\Backend;

/**
 * Author: Kaminski & Zangl
 * Date: 29.03.2022
 */


class Login
{

    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }


    public function checkCredentials()
    {
        require_once 'db_connect/connect.php';

        $email = $this->getEmail();
        $password = $this->getPassword();

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;

        //SELECT password and email from account and fetch it
        $sql = "SELECT * FROM account WHERE email = :email";
        $stmt = $connect->prepare($sql);
        $stmt->execute(array(':email' => $email));
        $result = $stmt->fetchAll();
        if (!$result) return false;
        $result = $result[0];
        if (!password_verify($password, $result['password'])) return false;
        return true;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }
}
