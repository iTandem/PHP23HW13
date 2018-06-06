<?php
    require_once 'task.php';
    
    $host = 'localhost:8889';
    $dbname = 'netology';
    $user = 'root';
    $pass = 'root';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    $descr = $_POST['description'] ?? '';
    $doneId = $_POST['done'] ?? '';
    $deleteId = $_POST['delete'] ?? '';
    $editId = $_POST['editId'] ?? '';
    
    $task = new Task($pdo);
    
    if($descr) {
        if($editId) {
            $task->updateTask($editId, $descr);
        } else {
            $task->insertTask($descr);
        }
    }
    if($doneId) {
        $task->completeTask($doneId);
    }
    if($deleteId) {
        $task->deleteTask($deleteId);
    }
    
    $columnOrder = $_POST['column'] ?? 'id asc';
    $queryResult = $task->findAllOrderBy($columnOrder);
    
    /**
     * Created by PhpStorm.
     * User: konstantin
     * Date: 05.06.2018
     * Time: 16:49
     */