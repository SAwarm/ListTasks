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
        $query = 'INSERT INTO tb_tarefas(tarefa) values(:task)';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':task', $this->task->__get('task'));
        return $stmt->execute();
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
        $query = 'UPDATE tb_tarefas set tarefa = :task where id = :id';

        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':task', $this->task->__get('task'));
        $stmt->bindValue(':id', $this->task->__get('id'));

        return $stmt->execute();
    }

    public function delete()
    {
        $query = 'DELETE FROM tb_tarefas where id = :id';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $this->task->__get('id'));
        
        return $stmt->execute();
    }
}