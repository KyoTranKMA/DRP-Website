<?php

namespace App\Core;

class Router {
    protected $routes = [];

    private function add ($method, $uri, $controller) {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    public function get($uri, $controller) {
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller) {
        $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller) {
        $this->add('DELETE', $uri, $controller);
    }
    public function put($uri, $controller) {
        $this->add('PUT', $uri, $controller);
    }

    public function patch($uri, $controller) {
        $this->add('PATCH', $uri, $controller);
    }

    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route['uri'] == $uri && $route['method'] == strtoupper($method)){
                $controller_action = $route['controller'];
                list($controller, $action) = explode('@', $controller_action);
                
                $controller = "App\\Controllers\\$controller";
                $controller_instance = new $controller();
                $controller_instance->$action();
                return;
            }
        }

        $this->loadError();
    }

    private function loadError($code = '404')
	{
        http_response_code($code);
        echo \App\Views\ViewRender::errorViewRender($code);
        die();
	}

}

?>
