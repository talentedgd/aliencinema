<?php

/* Класс роутер, который отвечает за маршруты */
class Router
{
    private $routes;

    /* Конструктор, для подключения файла с маршрутами и присовения переменной пути к корню проекта */
    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /* Метод получения строки запроса */
    private function getUri()
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    /* Метод, который прокладывает маршрут к нужным файлам */
    public function run()
    {
        $uri = $this->getUri();
        $resultInclude = false;
        foreach ($this->routes as $route => $path) {
            if (preg_match('~^' . $route . '$~', $uri)) {
                $data = preg_replace('~^' . $route . '$~', $path, $uri);
                $data = explode('/', $data);
                $controllerName = $data[0] . 'Controller';
                $controllerName = ucfirst($controllerName);
                array_shift($data);
                $actionName = 'action' . ucfirst($data[0]);
                array_shift($data);
                $params = array_filter($data);
                $controllerPath = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerPath)) {
                    include $controllerPath;
                }
                $controllerObj = new $controllerName();
                call_user_func_array([$controllerObj, $actionName], $params);
                $resultInclude = true;
                break;
            }
        }
        if (!$resultInclude) {
            echo 'page not found';
        }
    }
}