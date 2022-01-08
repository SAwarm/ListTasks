<?php

    require "./../model/task.model.php";
    require "./../model/task.service.php";
    require "./../model/connection.php";

    $task = new Task();
    $task->__set('task', $_POST['description_task']);

    $con = new Connection();

    $taskService = new TaskService($con, $task);
    $taskService->create();

