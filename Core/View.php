<?php

namespace core;

use App\Controllers\TaskController;

class View {

    public static function render(string $path, array $data = []) {

        $file = ROOT . '/app/views/' . $path . '.php';

        $data["logged"] = TaskController::isLogged();

        require_once  $file;
    }
}
