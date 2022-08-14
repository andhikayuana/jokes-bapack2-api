<?php

namespace Yuana\JokesBapack2Api;

use FastRoute;
use FastRoute\Dispatcher;

class App
{

    private $rootDir;
    private $controller;
    private $renderer;
    private $dataPath;
    private $jokesDataProvider;

    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
        $this->dataPath = $rootDir . DIRECTORY_SEPARATOR . 'storage';

        $this->configure();
    }

    private function configure()
    {
        $this->jokesDataProvider = new JokesDataProvider($this->dataPath);
        $this->controller = new Controller($this->jokesDataProvider);
        $this->renderer = new Renderer();
    }

    private function router()
    {
        return FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            
            $r->addRoute('GET', '/', 'index');
            $r->addRoute('GET', '/v1/text', 'getAll');
            $r->addRoute('GET', '/v1/text/random', 'getRandom');
        });
    }

    public function run()
    {
        $this->setupCors();
        $dispatcher = $this->router();
        $response = $this->controller->response();
        
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        
        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                $response = $this->controller->notFound();
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                $response = $this->controller->methodNotAllowed();
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                $response = $this->controller->$handler($vars);
                break;
        }

        $this->renderer->renderJson($response);
    }

    private function setupCors()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
            header('Access-Control-Allow-Headers: token, Content-Type');
            header('Access-Control-Max-Age: 1728000');
            header('Content-Length: 0');
            header('Content-Type: text/plain');
            die();
        }
        header('Access-Control-Allow-Origin: *');
    }
}