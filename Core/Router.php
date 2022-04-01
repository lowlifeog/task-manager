<?php

namespace core;

class Router {

    public static function run() {

        $path = $_SERVER['REQUEST_URI'];
        $pathParts = explode('/', $path);
        $controller = (empty($pathParts[1])) ? 'task' : $pathParts[1];
        $action = (empty($pathParts[2])) ? 'index' : $pathParts[2];
 
        $controller = 'app\controllers\\' . ucfirst($controller) . 'Controller';
        $action = 'action' . ucfirst($action);

        $action = explode('?', $action);
        $action = $action[0];

        if (!class_exists($controller)) {
            throw new \ErrorException('Controller does not exist');
        }
        
        $objController = new $controller;

        if (!method_exists($objController, $action)) {
            throw new \ErrorException('action does not exist');
        }

        call_user_func_array([$objController, $action], $_GET);
    }

}
