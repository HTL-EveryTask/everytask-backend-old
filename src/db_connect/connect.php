<?php
require_once 'config.php';

try {
    // $_SESSION["connect"] = new PDO('mysql:host=localhost;dbname=every_task_db', 'root', '');

    $connect = new PDO('mysql:host=localhost;dbname=every_task_db', 'root', '');

    //$connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);


    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database Connection Done\n";

    //for testing purposes (check if database is connected and can output data)
    // $sql = "SELECT * FROM account";
    // $stmt = $connect->prepare($sql);
    // $stmt->execute();
    // $result = $stmt->fetchAll();
    // foreach ($result as $row) {
    //     echo $row['email'] . " " . $row['password'] . "\n";
    // }

} catch (PDOException $error) {
    echo $error->getMessage();
}
