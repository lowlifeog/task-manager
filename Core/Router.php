<?php

namespace core;

class Router {
    
    private $routes = [];

    private $params = [];

    public function __construct() {
        $routesPath = ROOT . '/Core/Routes.php';
        require_once($routesPath);
    }

    public function add($route, $params = []){

        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    public function match($url){

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    public function dispatch($url){

        $url = $this->getUri($url);

        if ($this->match($url)) {

            $controller = $this->getNamespace() . ucfirst($this->params['controller']) . 'Controller';
            $action = 'action' . ucfirst($this->params['action']);

            if (class_exists($controller)) {
                $controller_object = new $controller;

                if (is_callable([$controller_object, $action])) {
                    unset($this->params['controller']);
                    unset($this->params['action']);
                    unset($this->params['namespace']);

                    call_user_func_array([$controller_object, $action], $this->params);
                } else {
                    throw new \Exception("Method $action in controller $controller cannot be called directly.");
                }
            } else {
                throw new \Exception("Controller class $controller not found");
            }
        } else {
            throw new \Exception('No route matched.', 404);
        }
    }

    private function getUri($url){

        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    private function getNamespace(){

        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }

}
