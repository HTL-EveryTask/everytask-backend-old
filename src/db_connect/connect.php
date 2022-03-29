<?php
    require 'config.php';

    try {
        $_SESSION["connect"] = new PDO('mysql:host=localhost;dbname=every_task_db', 'root', '');

        $connect = new PDO('mysql:host=localhost;dbname=every_task_db', 'root', '');

        //$connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);


        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Database Connection Done';


    } catch ( PDOException $error ) {
        echo $error->getMessage();
    }
