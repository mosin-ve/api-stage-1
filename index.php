<?php
require __DIR__ . '/vendor/autoload.php';
use App\Api;
use App\Controllers\TodoController;
use App\Middlewares\MethodNotAllowedMiddleware;
use App\Repositories\TodoRepository;
use App\Storage\JsonStorage;
use App\HttpMethods;


$todoStorage = new JsonStorage('data.json');
$todoRepository = new TodoRepository($todoStorage);
$todoController = new TodoController($todoRepository);

$api = new Api('api/v1');

$api->add_route(HttpMethods::GET, '/todos/:id', [$todoController, 'readTodo']);
$api->add_route(HttpMethods::GET, '/todos', [$todoController, 'listTodo']);
$api->add_route(HttpMethods::POST, '/todos', [$todoController, 'createTodo']);
$api->add_route(HttpMethods::PUT, '/todos/:id', [$todoController, 'editTodo']);
$api->add_route(HttpMethods::DELETE, '/todos/:id', [$todoController, 'deleteTodo']);

$middleware = new MethodNotAllowedMiddleware($api);
$todoController->setMiddleware($middleware);

$api->run();
