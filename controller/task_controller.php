<?php

    require "./../model/task.model.php";
    require "./../model/task.service.php";
    require "./../model/connection.php";

    $action = isset($_GET['action']) ? $_GET['action'] : $action;

    if (isset($_GET['action']) && ($_GET['action']) == 'create') {
        $task = new Task();
        $task->__set('task', $_POST['description_task']);

        $con = new Connection();

        $taskService = new TaskService($con, $task);
        $taskService->create();

        return header('Location: ./../views/new_task.php?include=1');

    } else if ($action == 'recover') {
        $task = new Task();
        $con = new Connection();

        $taskService = new TaskService($con, $task);
        $tasks = $taskService->recover();

        return $tasks;

    } else if ($action == 'update') {
        $task = new Task();
        $task->__set('id', $_POST['id']);
        $task->__set('task', $_POST['task']);
        
        $con = new Connection();

        $taskService = new TaskService($con, $task);

        if ($taskService->update() == 1) {

            if (!empty($_GET['pag'])){
                return header('Location: ./../views/index.php');
            }

            return header('Location: ./../views/all_tasks.php');
        }

    } else if ($action == 'delete') {
        $task = new Task();
        $task->__set('id', $_GET['id']);

        $con = new Connection();

        $taskService = new TaskService($con, $task);
        if ($taskService->delete() == 1) {

            if (!empty($_GET['pag'])){
                return header('Location: ./../views/index.php');
            }

            return header('Location: ./../views/all_tasks.php');
        }
    } else if ($action == "task_completed") {
        $task = new Task();
        $task->__set('id', $_GET['id']);
        $task->__set('id_status', 2);
        
        $con = new Connection();

        $taskService = new TaskService($con, $task);
        if ($taskService->taskCompleted() == 1) {

            if (!empty($_GET['pag'])){
                return header('Location: ./../views/index.php');
            }

            return header('Location: ./../views/all_tasks.php');
        }
    } else if ($action == 'recover_pending') {
        $task = new Task();
        $task->__set('id_status', 1);

        $con = new Connection();

        $taskService = new TaskService($con , $task);
        $tasks_pending = $taskService->recoverPending();

        return $tasks_pending;
    }
