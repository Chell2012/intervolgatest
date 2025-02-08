<?php
namespace Core;

/**
 * Роутер для напраления адресации
 */
class Router
{
    private $routes = [];

    /**
     * Добавление новых адресов в список
     * @param string $route
     * @param string $handler
     * @return void
     */
    public function add($route, $handler)
    {
        $this->routes[$route] = $handler;
    }

    /**
     * Добавление новых адресов в список
     * @param string $route
     * @param string $handler
     * @return void
     */
    public function parse($uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        foreach ($this->routes as $route => $handler) {
            if ($route === $uri) {
                $controllerInstance = new Controller();
                $controllerInstance->$handler();
                return;
            }
        }
        http_response_code(404);
        echo "404 Not Found";
    }
}