<?php

class TaskService
{
    private $connection;
    private $task;

    public function __construct(Connection $connection, Task $task)
    {
        $this->connection = $connection->connect();
        $this->task = $task;
    }

    public function create()
    {
        $query = 'INSERT INTO 
                        tb_tarefas(tarefa) 
                    VALUES
                        (:task)';

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
        $query = 'UPDATE 
                        tb_tarefas 
                    SET 
                        tarefa = :task 
                    WHERE 
                        id = :id';

        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':task', $this->task->__get('task'));
        $stmt->bindValue(':id', $this->task->__get('id'));

        return $stmt->execute();
    }

    public function delete()
    {
        $query = 'DELETE FROM 
                        tb_tarefas 
                    WHERE 
                        id = :id';

        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $this->task->__get('id'));

        return $stmt->execute();
    }

    public function taskCompleted()
    {
        $query = 'UPDATE 
                        tb_tarefas 
                    SET 
                        id_status= :id_status 
                    WHERE 
                        id = :id';

        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id_status', $this->task->__get('id_status'));
        $stmt->bindValue(':id', $this->task->__get('id'));

        return $stmt->execute();
    }

    public function recoverPending()
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
                    t.id_status = s.id
                WHERE
                    s.id = :id_status';

        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id_status', $this->task->__get('id_status'));

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
