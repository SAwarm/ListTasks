<?php

class TaskService {

    private $connection;
    private $task;

    public function __construct(Connection $connection, Task $task)
    {
        $this->connection = $connection->connect();
        $this->task = $task;
    }

    public function create()
    {
        $query = 'INSERT INTO tb_tarefas(tarefa) values(:tarefa)';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':tarefa', $this->task->__get('task'));
        $stmt->execute();
    }

    public function recover()
    {
        $query = 'SELECT 
                    t.id, s.status, tarefa AS task 
                FROM 
                    tb_tarefas 
                AS 
                    t
                LEFT JOIN 
                    tb_status
                AS
                    s
                ON
                    t.id_status = s.id';

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function update()
    {

    }

    public function delete()
    {
        
    }
}