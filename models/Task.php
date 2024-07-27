<?php

class Task
{
    private $conn;
    private $table = 'tasks';

    public $id;
    public $title;
    public $description;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getTask()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $opdb = $this->conn->prepare($query);
        $opdb->bindParam(1, $this->id);
        $opdb->execute();
        return $opdb;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (title, description, status) values(?, ?, ?)";
        $opdb = $this->conn->prepare($query);
        $opdb->bindParam(1, $this->title);
        $opdb->bindParam(2, $this->description);
        $opdb->bindParam(3, $this->status);
        if ($opdb->execute()) {
            return true;
        }
        return false;
    }
}
