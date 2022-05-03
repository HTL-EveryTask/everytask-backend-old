<?php

namespace Everytask\Backend;

/**
 * Version 1.1
 * Author: Kaminski & Zangl
 * Date: 26.04.2022
 */


class Task
{

    private $creator;
    private $title;
    private $description;
    private $done;
    private $due_time;
    private $created_time;
    private $note;


    public function __construct($creator, $title, $description, $done, $due_time, $created_time, $note)
    {
        $this->creator = $creator;
        $this->title = $title;
        $this->description = $description;
        $this->done = $done;
        $this->due_time = $due_time;
        $this->created_time = $created_time;
        $this->note = $note;
    }



    /**
     * Get All Tasks
     */
    public function getTask()
    {
        require 'db_connect/connect.php';

        $sql = "SELECT * FROM task";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    /**
     * TODO
     */
    public function getTask_byUser()
    {
        require 'db_connect/connect.php';
    }


    /**
     * TODO
     */
    public function getTask_byGroup()
    {
        require 'db_connect/connect.php';
    }




    /**
     * Adds the task to database
     */
    public function addTask()
    {
        require 'db_connect/connect.php';

        $creator = $this->getCreator();
        $title = $this->getTitle();
        $description = $this->getDescription();
        $done = $this->getDone();
        $due_time = $this->getDue_time();
        $created_time = $this->getCreated_time();
        $note = $this->getNote();

        
        $sql = "INSERT INTO task (fk_pk_account_id, title, description, done, due_time, create_time, note) 
                VALUES (:creator, :title, :description, :done, :due_time, :created_time, :note);";

        $stmt = $connect->prepare($sql);
        $stmt->execute(array(':creator' => $creator, ':title' => $title, ':description' => $description, ':done' => $done, ':due_time' => $due_time, ':created_time' => $created_time, ':note' => $note));

    }


    /**
     * Returns the Task ID
     */
    public static function getID($creator_id, $description, $due_time, $created_time)
    {   
        require 'db_connect/connect.php';

        $sql = "SELECT pk_task_id FROM task WHERE fk_pk_account_id = $creator_id AND description = $description AND due_time = $due_time AND created_time = $created_time";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll()[0]['fk_pk_account_id'];

    }


    
    /**
     * Updates old Task to new Task with given parameters
     */
    public function editTask($creator_new, $title_new, $description_new, $done_new, $due_time_new, $created_time_new, $note_new)
    {
        require 'db_connect/connect.php';

        $creator = $this->getCreator();
        $title = $this->getTitle();
        $description = $this->getDescription();
        $done = $this->getDone();
        $due_time = $this->getDue_time();
        $created_time = $this->getCreated_time();
        $note = $this->getNote();


        $sql = "UPDATE task
                SET fk_pk_account_id = $creator_new, title = $title_new, description = $description_new, done = $done_new, due_time = $due_time_new, created_time = $created_time_new, note = $note_new
                WHERE fk_pk_account_id = :creator AND description = :description AND due_time = :due_time AND created_time = :created_time;";

    }

    /**
     * Get the value of creator
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of done
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Get the value of due_time
     */
    public function getDue_time()
    {
        return $this->due_time;
    }

    /**
     * Get the value of created_time
     */
    public function getCreated_time()
    {
        return $this->created_time;
    }

    /**
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }
}
