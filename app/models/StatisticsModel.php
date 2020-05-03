<?php
require_once 'Database.php';

class StatisticsModel
{
    private $conn;
    private $errors = [];

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConn();
    }

    public function getErrors()
    {
        return $this->errors;
    }
}