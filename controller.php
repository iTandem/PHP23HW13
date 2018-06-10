<?php
    require_once 'task.php';
    
    $host = 'localhost';
    $dbname = 'cibizov';
    $user = 'cibizov';
    $pass = 'neto1762';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    $descr = isset($_POST['description']) ? $_POST['description'] : '';
    $doneId = isset($_POST['done']) ? $_POST['done'] : '';
    $deleteId = isset($_POST['delete']) ? $_POST['delete'] : '';
    $editId = isset($_POST['editId']) ? $_POST['editId'] : '';
    
    $task = new Task($pdo);
    
    if ($descr) {
        if ($editId) {
            $task->updateTask($editId, $descr);
        } else {
            $task->insertTask($descr);
        }
    }
    if ($doneId) {
        $task->completeTask($doneId);
    }
    if ($deleteId) {
        $task->deleteTask($deleteId);
    }
    
    $columnOrder = isset($_POST['column']) ? $_POST['column'] : 'id asc';
    $queryResult = $task->findAllOrderBy($columnOrder);
    
    /**
     * Created by PhpStorm.
     * User: konstantin
     * Date: 05.06.2018
     * Time: 16:49
     */