<?php

declare(strict_types=1);

namespace app\routes;

use app\controllers\ErrorController;

final class Router {

    private array $get;
    private array $post;

    public function get(string $uri, mixed $handle) : void {
        if(!isset($this->get[$uri])) {
            $this->get[$uri] = $handle;
        }
    }

    public function post(string $uri, mixed $handle) : void {
        if(!isset($this->post[$uri])) {
            $this->post[$uri] = $handle;
        }
    }

    public function dispatch() : void {
        $httpMethod = strtolower($_SERVER['REQUEST_METHOD']);
        $uri = $_SERVER['REQUEST_URI'];

        if(false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        if(!isset($this->$httpMethod[$uri])) {
            call_user_func_array([new ErrorController, 'notFound'], []);
            return;
        }
        $handle = $this->$httpMethod[$uri];

        [$controller, $method] = explode(':', $handle);

        $controllerNamespace = "app\\controllers\\{$controller}";
        $controllerInstance = new $controllerNamespace;

        call_user_func_array([$controllerInstance, $method], []);
    }
}
?>