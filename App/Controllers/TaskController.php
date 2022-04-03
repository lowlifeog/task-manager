<?php

namespace app\controllers;

use Core\View;
use Core\Pagination;
use App\Models\Task;

class TaskController {

    public function actionIndex($page = 1){

        session_start();

        if (isset($_POST['submit'])){

            $_SESSION['sort'] = $_POST['sort'];
            $_SESSION['order'] = $_POST['order'];
        } 

        $data['sort'] = intval($_SESSION['sort']);
        $data['order'] = intval($_SESSION['order']);

        switch ($data['sort']) {
            case 1: $sort = "task_name";
                break;
            case 2: $sort = "task_email";
                break;
            case 3: $sort = "task_status";
                break;
            default: $sort = "task_name";
        }

        switch ($data['order']) {
            case 1: $order = "ASC";
                break;
            case 2: $order = "DESC";
                break;
            default: $order = "ASC";
        }

        $total = Task::getTotalTasks();
        $limit = 3;
        $data['tasks'] = Task::getTasks($page, $limit, $sort, $order);
        $data['pagination'] = new Pagination($total, $limit, $page);

        return View::render('task/tasklist', $data);
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
                $data['result'] = Task::addTask($task);
            }
        }

        return View::render('task/taskadd', $data);
    }

    public function actionEdit(){

        $json = array();
        $data = array();

        if ($this -> isLogged()){

            if (isset($_POST['id'])){
                $data['id'] = $_POST['id'];

                $task = Task::getTask($data['id']);

                $data['text'] = $task['text'];
                $data['edit'] = $task['edit'];
                $data['status'] = $task['status'];

                if (isset($_POST['text'])){
                    $data['text'] = htmlspecialchars($_POST['text']);

                    if ($data['text'] != $task['text']){
                        $data['edit'] = 1;
                    }
                }

                if (isset($_POST['status'])){
                    $data['status'] = 1;
                }

                $result = Task::editTask($data);

                if ($result){
                    $json['edit'] = $data['edit'];
                    $json['status'] = $data['status'];
                }
            }
        } else {
            $json['redirect'] = true;
        }

        if ($json){
            echo json_encode($json);
        } else {
            header("Location: /");
        }
    }

    public function actionLogin(){

        $data = array();

        if (isset($_POST['submit'])){

            if (!$this -> isLogged()){

                $user = array(
                    'login' => htmlspecialchars($_POST['login']),
                    'pass' => htmlspecialchars($_POST['pass'])
                );
    
                $data['errors'] = $this ->validateLogin($user);
    
                if (!$data['errors']){
    
                    $userid = Task::checkUser($user);
    
                    if ($userid){

                        $this -> auth($userid);
                        header("Location: /");
                    } else {
                        $data['errors']['auth'] = "Login or password incorrect";
                    }
                }
            }  
        }

        return View::render('task/tasklogin', $data);
    }

    public function actionLogout(){

        session_start();

        unset($_SESSION['userid']);
        header("Location: /");
    }

    public function auth($userid){

        session_start();
        $_SESSION['userid'] = $userid;

    }

    public static function isLogged(){

        session_start();

        if ($_SESSION['userid']){
            return true;
        }

        return false;
    }
    

    private function validateLogin($user){

        $errors = array();

        if (strlen(trim($user['login'])) < 1){
			$errors['login'] = 'Login field cannot be empty';
		}
        if (strlen($user['pass']) < 1){
			$errors['pass'] = 'Password field cannot be empty';
		}

        return $errors;
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
