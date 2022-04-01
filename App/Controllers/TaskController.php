<?php

namespace app\controllers;

use Core\View;
use App\Models\Task;

class TaskController {

    public function actionIndex() {

        $tasks = Task::getTasks();

        View::render('taskmanager', $tasks);
    }

}
