<?php

namespace core;

use App\Controllers\TaskController;

class View {

    public static function render($path, $data = []) {

        $file = ROOT . '/App/Views/' . $path . '.php';

        $data["logged"] = TaskController::isLogged();

        require_once  $file;
    }
}
