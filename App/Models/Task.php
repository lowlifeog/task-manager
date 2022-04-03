<?php

namespace app\models;

use Core\DB;
use PDO;

class Task {

    public static function getTasks($page = 1, $limit = 3, $sort = 'task_user', $order = 'ASC'){
        $db = DB::connect();

        $offset = $limit * ($page - 1);

        $query = "SELECT * "
                . "FROM task "
                . "ORDER BY $sort $order "
                . "LIMIT $limit "
                . "OFFSET $offset";;

        $result = $db->query($query);

        $tasks = array();

        foreach ($result as $row) {
            $tasks[] = array(
                'id' => $row['task_id'],
                'name' => $row['task_name'],
                'email' => $row['task_email'],
                'text' => $row['task_text'],
                'status' => $row['task_status'],
                'edit' => $row['task_edit']
            );
        }

        return $tasks;
    }

    public static function getTask($id){
        $db = DB::connect();


        $query = "SELECT * "
                . "FROM task "
                . "WHERE "
                . "task_id = $id";

        $result = $db->query($query);

        $row = $result->fetch(PDO::FETCH_ASSOC);

        $task = array(
            'id' => $row['task_id'],
            'name' => $row['task_name'],
            'email' => $row['task_email'],
            'text' => $row['task_text'],
            'status' => $row['task_status'],
            'edit' => $row['task_edit']
        );

        return $task;
    }

    public static function getTotalTasks(){
        $db = DB::connect();

        $query = "SELECT COUNT(*) AS count "
                . "FROM task";

        $result = $db->query($query);

        $result = $result->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }

    public static function addTask($task){

        $db = DB::connect();

        $query = "INSERT INTO task SET "
                . "task_name = :name, "
                . "task_email = :email, "
                . "task_text = :text";

        $result = $db->prepare($query);
        $result->bindParam(':name', $task['name'], PDO::PARAM_STR);
        $result->bindParam(':email', $task['email'], PDO::PARAM_STR);
        $result->bindParam(':text', $task['text'], PDO::PARAM_STR);

        return $result->execute();
    }

    public static function editTask($data){

        $db = DB::connect();

        $query = "UPDATE task SET "
                . "task_text = :text, "
                . "task_status = :status, "
                . "task_edit = :edit "
                . "WHERE "
                . "task_id = :id";


        $result = $db->prepare($query);
        $result->bindParam(':text', $data['text'], PDO::PARAM_STR);
        $result->bindParam(':status', $data['status'], PDO::PARAM_INT);
        $result->bindParam(':edit', $data['edit'], PDO::PARAM_INT);
        $result->bindParam(':id', $data['id'], PDO::PARAM_INT);

        return $result->execute();

    }

    public static function checkUser($user){

        $db = DB::connect();

        $query = "SELECT * FROM user WHERE "
                . "login = :login AND "
                . "pass = :pass";

        $result = $db->prepare($query);
        $result->bindParam(':login', $user['login'], PDO::PARAM_STR);
        $result->bindParam(':pass', $user['pass'], PDO::PARAM_STR);

        $result->execute();

        $data = $result->fetch(PDO::FETCH_ASSOC);
        if ($data){
            return $data['user_id'];
        }

        return false;
    }
}