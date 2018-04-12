<?php

// ROUTER

class route
{
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }

    // public function define ($routes) {
    //     $this->routes = $routes;
    // }

    public function get($uri, $page)
    {
        $this->routes['GET'][$uri] = $page;
    }

    public function post($uri, $page)
    {
        $this->routes['POST'][$uri] = $page;
    }

    public function direct($uri, $methodType)
    {
        if (array_key_exists($uri, $this->routes[$methodType])) {
            return $this->routes[$methodType][$uri];
        }
        throw new Exception('No route difined for this URI.');
    }
}

// BROWSER FUNCTIONS

class requests
{
    public static function URI()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function METHOD()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
