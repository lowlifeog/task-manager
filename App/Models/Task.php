<?php

namespace app\models;

use Core\DB;
use PDO;

class Task {

    public static function getTasks(){
        $db = DB::connect();

        $query = "SELECT * "
                . "FROM task ";

        $result = $db->query($query);

        foreach ($result as $row) {
            $tasks[] = array(
                'id' => $row['task_id'],
                'name' => $row['task_name'],
                'email' => $row['task_email'],
                'text' => $row['task_text'],
                'status' => $row['task_status'],
            );
        }

        return $tasks;
    }

    public static function addTask($name, $email, $text) {

        $db = DB::connect();

        $query = "INSERT INTO task SET "
                . "task_name = :name, "
                . "task_email = :email, "
                . "task_text = :text";

        $result = $db->prepare($query);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);

        return $result->execute();
    }
}