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

    public function createTask()
    {
        $data = json_decode(file_get_contents("php://input"));
        $this->task->title = $data->title;
        $this->task->description = $data->description;
        $this->task->status = $data->status;
        if ($this->task->create()) {
            echo json_encode(array('message' => 'Registro de tarea con éxito.', 'status' => 200));
        } else {
            echo json_encode(array('message' => 'Ocurrio un error.', 'status' => 500));
        }
    }

    public function updateTask($id){
        $this->task->id = $id;
        $data = json_decode(file_get_contents("php://input"));
        $this->task->title = $data->title;
        $this->task->description = $data->description;
        $this->task->status = $data->status;
        $this->task->id = $id;
        if($this->task->updateTask()){
            echo json_encode(array('message' => 'Modificacion de tarea con exito', 'status' => 200));
        }else{{
            echo json_encode(array('message' => 'Ocurrio un error', 'status' => 500));
        }}
    }

    public function getTask($id)
    {
        $this->task->id = $id;
        $opdb = $this->task->getTask();
        $individual_task = $opdb->fetchAll(PDO::FETCH_ASSOC);
        if ($individual_task) {
            echo json_encode($individual_task);
        } else {
            echo json_encode(array("message" => "Tarea no encontrada"));
        }
    }

    public function getAllTask()
    {
        $opdb = $this->task->getAllTask();
        $get_general_task = $opdb->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($get_general_task);
    }

    public function deleteTask($id)
    {
        $this->task->id = $id;
        if ($this->task->deleteTask()) {
            echo json_encode(array('message' => 'Eliminación de tarea con éxito.', 'status' => 200));
        } else {
            echo json_encode(array('message' => 'Ocurrio un error al eliminar la tarea.', 'status' => 500));
        }
    }
}
