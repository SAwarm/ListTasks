<?php

class Task
{
    private $id;
    private $id_status;
    private $task;
    private $date_include;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }
}
