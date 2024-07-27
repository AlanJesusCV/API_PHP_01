<?php
include_once '../API_PHP_01/controllers/TaskController.php';

$taskController = new TaskController();

$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET['id'])) {
            $id = intval($_GET['id']);
            $taskController->getTask($id);
            break;
        }
    case 'POST':
        $taskController->createTask();
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
