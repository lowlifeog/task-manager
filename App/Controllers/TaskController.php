<?php

namespace app\controllers;

use Core\View;
use App\Models\Task;

class TaskController {

    public function actionIndex(){

        $tasks = Task::getTasks();

        View::render('task/tasklist', $tasks);
    }

    public function actionAdd(){
        $data = array();

        if (isset($_POST['submit'])){

            
            $task = array(
                'name' => htmlspecialchars($_POST['name']),
                'email' => $_POST['email'],
                'text' => htmlspecialchars($_POST['text']),
            );
            
            $data['errors'] = $this->validateTask($task);
            
            if (!$data['errors']){
                $data['result'] = Task::addTask($task['name'], $task['email'], $task['text']);
            }
        }

        View::render('task/taskadd', $data);
    }
    
    private function validateTask($task){

        $errors = array();

        if (strlen(trim($task['name'])) < 1 || strlen(trim($task['name'])) > 32){
			$errors['name'] = 'Name must be of 1 to 32 characters';
		}
        if (strlen($task['email']) > 64 || !filter_var($task['email'], FILTER_VALIDATE_EMAIL)){
			$errors['email'] = 'E-mail is invalid';
		}
        if (strlen($task['text']) < 1 ){
			$errors['text'] = 'Task text is invalid';
		}

        return $errors;
    }

}
