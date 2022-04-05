<?php

namespace Everytask\Backend;

use Login;

require_once 'vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("content-type: application/json");


//data returned is only for testing purposes (real data is not returned)
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $data = [
        'email' => $_POST['username'],
        'password' => $_POST['password']
    ];
    echo json_encode(['success' => true, 'data' => $data]);
    $data1 = new Login($data['email'], $data['password']);
    if ($data1->checkCredentials()) {
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'data' => 'cat']);
    }
}
