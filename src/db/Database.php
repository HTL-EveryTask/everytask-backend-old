<?php

/**
 * Version 1.0
 * Author: Kaminski & Zangl
 * Date: 26.04.2022
 */

class Database {
    protected $input;

    public function __construct($input)
    {
        $this->input = $input;
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