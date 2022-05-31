<?php

namespace Everytask\Backend;

/**
 * Version 1.0
 * Author: Kaminski
 * Date: 31.05.2022
 */

class Group
{
    private $name;
    private $icon;
    private $description;
    private $group_id;

    public function __construct($name, $icon, $description)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->description = $description;
    }


    /**
     * Adds the task to database
     */
    public function addGroup()
    {
        require 'db_connect/connect.php';

        $name = $this->getName();
        $icon = $this->getIcon();
        $description = $this->getDescription();

        $sql = "INSERT INTO `group` (name, icon, description) VALUES
                (:name, :icon, :description);";

        $stmt = $connect->prepare($sql);
        $stmt->execute(array(':name' => $name, ':icon' => $icon, ':description' => $description));
    }



    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

}