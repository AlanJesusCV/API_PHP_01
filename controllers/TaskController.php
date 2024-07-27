<?php
include_once '../API_PHP_01/config/database.php';
include_once '../API_PHP_01/models/Task.php';

class TaskController
{

    private $db;
    private $task;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->makeConnection();
        $this->task = new Task($this->db);
    }

    public function createTask(){
        $data = json_decode(file_get_contents("php://input"));
        $this->task->title = $data->title;
        $this->task->description = $data->description;
        $this->task->status = $data->status;
        if($this->task->create()){
            echo json_encode(array('message'=>'Registro de tarea con éxito.', 'status'=>200));
        }else{
            echo json_encode(array('message'=>'Ocurrio un error.', 'status'=>500));
        }
    }

    public function getTask($id){
        $this->task->id = $id;
        $opdb = $this->task->getTask();
        $individual_task = $opdb->fetchAll(PDO::FETCH_ASSOC);
        if($individual_task){
            echo json_encode($individual_task);
        }else{
            echo json_encode(array("message" => "Tarea no encontrada"));
        }
    }
}
