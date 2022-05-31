<?php
/**
 * Start PHP Server on Localhost 8080
 * php -S localhost:8080
 *
 * Frontend:
 * npm run dev
 */

use Everytask\Backend\Login;
use Everytask\Backend\Register;
use Everytask\Backend\User;
use Everytask\Backend\Task;

require_once 'vendor/autoload.php';
require_once 'src/Task.php';

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
        echo json_encode(array('status' => 'success', 'token' => User::getToken_byEmail($POST['email'])));
    } else {
        echo json_encode(array('status' => 'error'));
    }
}

// Checks if register credentials matching requirements and create account
if (isset($POST['action']) && $POST['action'] == 'register') {
    $user = new Register($POST['email'], $POST['password'], $POST['username']);
    if ($user->validateRegister()) {
        echo json_encode(array('Registration Data' => 'allowed'));
        $user->createAccount();
    } else {
        echo json_encode(array('Registration Data' => 'not allowed'));
    }
}


// Send User ID by Token
if (isset($POST['action']) && $POST['action'] == 'get_UserID') {
    echo json_encode(array('User ID' => User::getUserID_byToken($POST['token'])));

}






// Add new Task
if (isset($POST['action']) && $POST['action'] == 'addTask') {

    $task = new Task(User::getUserID_byToken($POST['token']), $POST['title'], $POST['description'], $POST['is_done'], $POST['due_time'], $POST['created_time'], $POST['note']);
    $task_id = Task::getID(User::getUserID_byToken($POST['token']), $POST['description'], $POST['due_time'], $POST['created_time']);

    print_r($task);

    if (!empty($task)) {
        echo json_encode("Task not added");
    }

    if (!empty($task_id)) {
        echo json_encode(array('Task added' => 'true', 'task_id' => $task_id));
        return;
    }
    
    echo json_encode(array('Task added' => 'error occured, check sent data'));

}

// Delete Task
if (isset($POST['action']) && $POST['action'] == 'deleteTask') {
    if($POST['task_id'] == '' || $POST['task_id'] == null || $POST['task_id'] == 'undefined') {
        echo json_encode(array('Task deleted' => 'false'));
        return;
    }
    Task::deleteTask($POST['task_id']);
    echo json_encode(array('Task deleted' => 'true'));
}


// Get all Task
if (isset($POST['action']) && $POST['action'] == 'getTasks') {
    echo json_encode(Task::getTasks());
}


// Get Task ID
if (isset($POST['action']) && $POST['action'] == 'getTaskID') {
    echo json_encode(array('Task ID' => Task::getID(User::getUserID_byToken($_POST['token']), $_POST['description'], $_POST['due_time'], $_POST['create_time'])));
}


/**
 * EDIT TASK
 *
 * needed POST's:
 *      task_id
 *      creator_id_new
 *      title_new
 *      description_new
 *      done_new
 *      due_time_new
 *      create_time_new
 *      note_new
 */
if (isset($POST['action']) && $POST['action'] == 'editTask') {

    $task_data = Task::getTask($_POST['task_id']);
    $task = new Task($task_data['fk_pk_account_id'], $task_data['title'], $task_data['description'], $task_data['done'], $task_data['due_time'], $task_data['create_time'], $task_data['note']);

    $task->editTask($_POST['creator_id_new'], $_POST['title_new'], $_POST['description_new'], $_POST['done_new'], $_POST['due_time_new'], $_POST['create_time_new'], $_POST['note_new']);
}