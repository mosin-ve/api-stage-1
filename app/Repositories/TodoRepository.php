<?php

namespace App\Repositories;
use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;
use App\Storage\JsonStorage;
use App\Exceptions\NotFound;
use function PHPUnit\Framework\isEmpty;

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
require_once "app\Exceptions\NotFound.php";


class  TodoRepository implements TodoRepositoryInterface
{
    public JsonStorage $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    public function get_all(): array
    {
        $all_todos = $this->storage->read();
        $todo_ar = [];
        foreach ($all_todos as $var) {
            $todo = new Todo();
            $todo->set_id($var['id']);
            $todo->set_description($var['description']);
            $todo->set_completed($var['completed']);
            $todo_ar[] = $todo;
        }
        return $todo_ar;
    }

    public function get_by_id(int $id): Todo
    {
        $search = $this->storage->search('id', $id);
        if (isEmpty($search)) {
//          throw new NotFound();
            $todo = new Todo();
            $todo->set_id($id);
            $todo->set_description('no');
            $todo->set_completed(0);

            return $todo;
        } else {
            $todo = new Todo();
            $todo->set_id($search['id']);
            $todo->set_description($search['description']);
            $todo->set_completed($search['completed']);

            return $todo;
        }
    }

    public function add(mixed $data): Todo
    {
        $all_todos = $this->storage->read();
        $blank_todo = [
            'id' => 0,
            'description' => '',
            'completed' => "0"
        ];

        do {
            $random_id = mt_rand(100000000, 999999999);
        } while (in_array($random_id, $all_todos, true));
        $todo = new Todo();
        $todo->set_id($random_id);
        $todo->set_description($data['description']);
        $todo->set_completed($data['completed']);
        $new_todo = $blank_todo;
        $new_todo['id'] = $random_id;
        $new_todo['description'] = $todo->get_description();
        $new_todo['completed'] = $todo->is_completed();
        $all_todos[] = $new_todo;
        $this->storage->write($all_todos);
        return $todo;
    }

    /**
     * @throws NotFound
     */
    public function update(int $id, mixed $data): Todo
    {

        if (is_array($data)) {
            $input = $data;
        } else $input = [];

        $all_todos = $this->storage->read();

        $newTodo = null;
        $exists = false;
        foreach ($all_todos as &$todo) {
            if ($todo['id'] === $id) {
                $exists = true;
                if (array_key_exists('description', $input))
                {
                    if ($input['description'] !== null) {
                        $todo['description'] = $input['description'];
                    }
                }
                If (array_key_exists('completed', $input)) {
                    if ($input['completed'] !== null) {
                        $todo['completed'] = $input['completed'];
                    }
                }
                $newTodo = new Todo();
                $newTodo->set_id($todo['id']);
                $newTodo->set_description($todo['description']);
                $newTodo->set_completed($todo['completed']);

                break;
            }
        }
        if (!$exists) {
            throw new NotFound();
        }
        $this->storage->write($all_todos);

        return $newTodo;
    }

    /**
     * @throws NotFound
     */
    public function delete($id)
    {
        $all_todos = $this->storage->read();
        $success = false;
        foreach ($all_todos as $key => $all_todo) {
            if ($all_todo['id'] == $id) {
                unset($all_todos[$key]);
                $success = true;
                break;
            }
        }
        if ($success) {
            $this->storage->write($all_todos);
            return 'Successful delete operation';
        } else {
            throw new NotFound();
        }
    }
}