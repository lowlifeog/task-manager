<?php

namespace app\models;

use Core\DB;

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
}