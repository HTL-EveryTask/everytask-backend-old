<?php

namespace Everytask\Backend;

/**
 * Author: Kaminski & Zangl
 * Date: 19.04.2022
 */


class Register
{

    private $email;
    private $password;
    private $username;

    public function __construct($email, $password, $username)
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
    }


    /**
     * Check if Input correct for registration
     * @return bool
     */
    public function validateRegister()
    {
        require 'db_connect/connect.php';

        $email = $this->getEmail();
        $password = $this->getPassword();
        $username = $this->getUsername();

        // Validate Email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;


        // Validate Password
        if (!preg_match('/[A-Z]/', $password) && !strlen($password) >= 8) return false;


        // Check if Username & Email already used
        $sql = "SELECT email, username FROM account WHERE email = :email OR username = :username";
        $stmt = $connect->prepare($sql);
        $stmt->execute(array(':email' => $email, ':username' => $username));
        $result = $stmt->fetchAll();
        if ($result) return false;

        return true;
    }

    /**
     * Create Account
     */
    public function createAccount()
    {
        require 'db_connect/connect.php';

        $email = $this->getEmail();
        $password = password_hash($this->getPassword(), PASSWORD_DEFAULT);
        $username = $this->getUsername();

        // Check if Username & Email already used
        $sql = "INSERT INTO `account` (`username`, `password`, `email`)
                VALUES (:username, :password, :email);";

        $stmt = $connect->prepare($sql);
        $stmt->execute(array(':email' => $email, ':username' => $username, ':password' => $password));

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

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }
}
