<?php

/**
 * Start PHP Server on Localhost 8080
 * php -S localhost:8080
 *
 * Frontend:
 * npm run dev
 */

use Everytask\Backend\Group;
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
$_POST = json_decode($phpInput, true);

// Checks if the user exists and if the password is correct
if (isset($_POST['action']) && $_POST['action'] == 'login') {

    if (!isset($_POST['email'])) echo json_encode('No email received');
    if (!isset($_POST['password'])) echo json_encode('No password received');

    $user = new Login($_POST['email'], $_POST['password']);
    if ($user->checkCredentials()) {
        echo json_encode(array('status' => 'success', 'token' => User::getToken_byEmail($_POST['email']), 'email' => $user->getEmail()));
    } else {
        echo json_encode(array('status' => 'error'));
    }
}

// Checks if register credentials matching requirements and create account
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    if (!isset($_POST['email'])) echo json_encode('No email received');
    if (!isset($_POST['password'])) echo json_encode('No password received');
    if (!isset($_POST['username'])) echo json_encode('No username received');

    $user = new Register($_POST['email'], $_POST['password'], $_POST['username']);
    if ($user->validateRegister()) {
        echo json_encode(array('Registration Data' => 'allowed'));
        $user->createAccount();
    } else {
        echo json_encode(array('Registration Data' => 'not allowed'));
    }
}


// Send User ID by Token
if (isset($_POST['action']) && $_POST['action'] == 'get_UserID') {
    if (!isset($_POST['token'])) echo json_encode('No token received');

    echo json_encode(array('User ID' => User::getUserID_byToken($_POST['token'])));
}

// Add new Task
if (isset($_POST['action']) && $_POST['action'] == 'addTask') {
    if (!isset($_POST['token'])) echo json_encode('No token received');
    if (!isset($_POST['group_id'])) echo json_encode('No group_id received');
    if (!isset($_POST['title'])) echo json_encode('No title received');
    if (!isset($_POST['description'])) echo json_encode('No description received');
    if (!isset($_POST['is_done'])) echo json_encode('No is_done received');
    if (!isset($_POST['due_time'])) echo json_encode('No due_time received');
    if (!isset($_POST['created_time'])) echo json_encode('No create_time received');
    if (!isset($_POST['note'])) {
        echo json_encode('No note received');
        $note = '';
    }
    if (isset($_POST['note'])) $note = $_POST['note'];

    $task = new Task(User::getUserID_byToken($_POST['token']), $_POST['group_id'], $_POST['title'], $_POST['description'], $_POST['is_done'], $_POST['due_time'], $_POST['created_time'], $note);
    $task->addTask();
    $task_id = Task::getID(User::getUserID_byToken($_POST['token']), $_POST['description'], $_POST['due_time'], $_POST['created_time']);


    if (empty($task)) {
        echo json_encode("Task not added");
        return;
    }

    if (!empty($task_id)) {
        echo json_encode(array('Task added' => 'true', 'task_id' => $task_id));
        return;
    }

    echo json_encode(array('Task not added' => 'error occured, check sent data'));
}

// Delete Task
if (isset($_POST['action']) && $_POST['action'] == 'deleteTask') {

    if (!isset($_POST['task_id'])) echo json_encode('No task_id received');

    if ($_POST['task_id'] == '' || $_POST['task_id'] == null || $_POST['task_id'] == 'undefined') {
        echo json_encode(array('Task deleted' => 'false'));
        return;
    }
    Task::deleteTask($_POST['task_id']);
    echo json_encode(array('Task deleted' => 'true'));
}


// Get all Task
if (isset($_POST['action']) && $_POST['action'] == 'getTasks') {
    echo json_encode(Task::getTasks());
}


// Get Task ID
if (isset($_POST['action']) && $_POST['action'] == 'getTaskID') {
    if (!isset($_POST['token'])) echo json_encode('No token received');
    if (!isset($_POST['description'])) echo json_encode('No description received');
    if (!isset($_POST['due_time'])) echo json_encode('No due_time received');
    if (!isset($_POST['create_time'])) echo json_encode('No create_time received');


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
if (isset($_POST['action']) && $_POST['action'] == 'editTask') {

    if (!isset($_POST['task_id'])) echo json_encode('No task_id received');
    if (!isset($_POST['creator_id_new'])) echo json_encode('No creator_id_new received');
    if (!isset($_POST['title_new'])) echo json_encode('No title_new received');
    if (!isset($_POST['description_new'])) echo json_encode('No description_new received');
    if (!isset($_POST['done_new'])) echo json_encode('No done_new received');
    if (!isset($_POST['due_time_new'])) echo json_encode('No due_time_new received');
    if (!isset($_POST['create_time_new'])) echo json_encode('No create_time_new received');
    if (!isset($_POST['note_new'])) echo json_encode('No note_new received');

    $task = Task::getTask($_POST['task_id']);

    $task->editTask($_POST['creator_id_new'], $_POST['title_new'], $_POST['description_new'], $_POST['done_new'], $_POST['due_time_new'], $_POST['create_time_new'], $_POST['note_new']);
}


/**
 * Add new Group
 *
 * needed POST's:
 *
 *      group_name
 *      group_icon
 *      group_description
 */
if (isset($_POST['action']) && $_POST['action'] == 'addGroup') {

    if (!isset($_POST['group_name'])) echo json_encode('No group_name received');
    if (!isset($_POST['group_icon'])) echo json_encode('No group_icon received');
    if (!isset($_POST['group_description'])) echo json_encode('No group_description received');

    $group = new Group($_POST['group_name'], $_POST['group_icon'], $_POST['group_description']);
    $group->addGroup();

    if (empty($group)) {
        echo json_encode(array('Group not added' => 'error occured, check sent data'));
    } else {
        echo json_encode(array('Group added' => 'true'));
    }
}


/**
 * Mark Task as Done / not Done
 *
 * needed POST's:
 *      task_id
 */

if (isset($_POST['action']) && $_POST['action'] == 'switch_task_status') {

    if (!isset($_POST['task_id'])) echo json_encode('No task_id received');

    try {
        $task = Task::getTask($_POST['task_id']);
        $task->mark_all();
        echo json_encode(array('Task status switched' => 'success'));
    } catch (Exception $e) {
        echo json_encode(array('Task status switched' => 'error'));
    }
}
