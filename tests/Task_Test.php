<?php


use Everytask\Backend\Task;
use Everytask\Backend\User;
use PHPUnit\Framework\TestCase;

class Task_Test extends TestCase
{

    public function test_createTaskObject()
    {
        $task = new Task(1, 'test task', 'description hehe', false, '2019-03-10 02:55:05', '2018-03-10 02:55:05', '');
        $this->assertTrue(
            isset($task)
        );
    }

    public function test_addTask()
    {
        $task = new Task(1, 'test task', 'description hehe', false, '2019-03-10 02:55:05', '2018-03-10 02:55:05', '');
        $task->addTask();
        $res = Task::getID(1, 'description hehe', '2019-03-10 02:55:05', '2018-03-10 02:55:05');
        $this->assertTrue(
            isset($res)
        );
    }

    public function test_getTasks()
    {
        $res = Task::getTasks();
        print_r($res);
        $this->assertTrue(
            isset($res)
        );
    }

    public function test_deleteTask()
    {
        $task = new Task(1, 'test task', 'description haha', false, '2019-03-10 02:55:05', '2018-03-10 02:55:05', '');
        $task->addTask();
        $id = Task::getID(1, 'description haha', '2019-03-10 02:55:05', '2018-03-10 02:55:05');
        Task::deleteTask($id[0][0]);
        $res = Task::getTasks();

        $this->assertTrue(
            empty($res)
        );
    }

    public function test_getUserID_byToken()
    {
        $this->assertTrue(
            User::getUserID_byToken('admin')[0][0] == 1
        );
    }


    public function test_editTask()
    {
        $task = new Task(6, 'test task', 'description haha', false, '2019-03-10 02:55:05', '2018-03-10 02:55:05', '');
        $task->addTask();
        $task->editTask(6, 'Cool Updated Task', 'new description haha', false, '2019-03-10 02:55:05', '2018-03-10 02:55:05', '');

        $this->assertTrue(
            true
        );
    }

}