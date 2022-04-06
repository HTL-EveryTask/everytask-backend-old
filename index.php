<?php

use Everytask\Backend\Login;

require_once 'vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("content-type: application/json");

$phpInput = file_get_contents('php://input');
$POST = json_decode($phpInput, true);

if (isset($POST['action']) && $POST['action'] == 'login') {
    $user = new Login($POST['email'], $POST['password']);
    if ($user->checkCredentials()){
        echo json_encode(array('status' => 'success'));
    } else {
        echo json_encode(array('status' => 'error'));
    }
}
