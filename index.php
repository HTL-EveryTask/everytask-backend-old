<?php

use Everytask\Backend\Login;

require_once 'vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

// gets Input from the request
$phpInput = file_get_contents('php://input');

// Decodes the input
$POST = json_decode($phpInput, true);

// Checks if the user exists and if the password is correct
if (isset($POST['action']) && $POST['action'] == 'login') {
    $user = new Login($POST['email'], $POST['password']);
    if ($user->checkCredentials()) {
        echo json_encode(array('status' => 'success'));
    } else {
        echo json_encode(array('status' => 'error'));
    }
}
