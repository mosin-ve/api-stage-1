<?php
require __DIR__ . '/vendor/autoload.php';
use App\Api;
use App\Controllers\TodoController;
use App\Repositories\TodoRepository;
use App\Storage\JsonStorage;
use App\HttpMethods;

require_once "app\Interfaces\StorageInterface.php";
require_once "app\Interfaces\TodoInterface.php";
require_once "app\Interfaces\TodoRepositoryInterface.php";
require_once "app\Storage\JsonStorage.php";
require_once "app\Models\Todo.php";
require_once "app\Repositories\TodoRepository.php";
require_once "app\Controllers\TodoController.php";
require_once "app\Api.php";
require_once "app\HttpMethods.php";
require_once "app\HttpRequest.php";
require_once "app\JsonResponse.php";
require_once "app\Route.php";

$todoStorage = new JsonStorage('data.json');
$todoRepository = new TodoRepository($todoStorage);
$todoController = new TodoController($todoRepository);

$api = new Api('api/v1');

$api->add_route(HttpMethods::GET, '/todos/:id', [$todoController, 'readTodo']);
$api->add_route(HttpMethods::GET, '/todos', [$todoController, 'listTodo']);
$api->add_route(HttpMethods::POST, '/todos', [$todoController, 'createTodo']);
$api->add_route(HttpMethods::PUT, '/todos/:id', [$todoController, 'editTodo']);
$api->add_route(HttpMethods::DELETE, '/todos/:id', [$todoController, 'deleteTodo']);

$api->run();
