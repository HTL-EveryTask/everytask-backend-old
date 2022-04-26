<?php

/**
 * Version 1.0
 * Author: Kaminski & Zangl
 * Date: 26.04.2022
 */

class Database {
    protected $input;
    protected $action;

    public function __construct($input, $action)
    {
        $this->input = $input;
        $this->action = $action;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function getAction()
    {
        return $this->action;
    }
}