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
    private $token;

    /**
     * @param $email
     * @param $password
     * @param $username
     */
    public function __construct($email, $password, $username)
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->token = $this->generateToken();
    }

    /**
     * Used to Generate a token with length 16
     * @return String Generated User Token
     */
    private function generateToken(){
        $token = openssl_random_pseudo_bytes(16);
        return bin2hex($token);
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
        $token = $this->getToken();

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

        // Check if Token in use -> Generate new if exists
        $token_sql = "SELECT token FROM account WHERE token = :token";
        $token_stmt = $connect->prepare($token_sql);
        $token_stmt->execute(array(':token' => $token));
        $fetched_token = $token_stmt->fetchAll();
        if ($fetched_token) {
            $this->token = $this->generateToken();
            $this->validateRegister();
        };

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
        $token = $this->getToken();

        // Check if Username & Email already used
        $sql = "INSERT INTO `account` (`username`, `password`, `email`, `token`)
                VALUES (:username, :password, :email, :token);";

        $stmt = $connect->prepare($sql);
        $stmt->execute(array(':email' => $email, ':username' => $username, ':password' => $password, ':token' => $token));

    }

    public static function getUsername_ByEmail($email)
    {
        require 'db_connect/connect.php';
        $sql = "SELECT username FROM account WHERE email = :email";
        $stmt = $connect->prepare($sql);
        $stmt->execute(array(':email' => $email));
        $result = $stmt->fetchAll();
        return $result[0]['username'];
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

    /**
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }
}
