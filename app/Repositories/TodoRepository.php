<?php

namespace App\Repositories;

use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;
use App\Storage\JsonStorage;
use Exception;

class TodoRepository implements TodoRepositoryInterface
{
    private array $todo;
    public int $id;
    private JsonStorage $json_file;

    public function __construct(JsonStorage $json_file)
    {
        $this->storage = $json_file;
        $this->todo = new Todo;
    }

    public function get_all(): array
    {
        $this->json_file = read();
        return $this->todo;
    }

    public function get_by_id(int $id): Todo
    {
        $todo = $this->json_file->search('id', $id);
        $this->todo->set_id($todo['id']);
        $this->todo->set_description($todo['description']);
        $this->todo->set_completed($todo['completed']);

        return $this->todo;

    }

    public function add(mixed $data): Todo
    {
        $todos = $this->storage->read();
        $todos[] = $data;
        $this->storage->write($todos);
        $this->todo->set_id($data['id']);
        $this->todo->set_description($data['description']);
        $this->todo->set_completed($data['completed']);

        return $this->todo;
    }

    public function update(int $id, mixed $data): Todo|bool
    {
        try {
            $todo = $this->storage->update($data, $id);
        } catch (Exception $e) {
            return false;
        }

        $this->todo->set_id($todo['id']);
        $this->todo->set_description($todo['description']);
        $this->todo->set_completed($todo['completed']);

        return $this->todo;
    }

    public function delete($id)
    {
        $this->storage->delete($id);
    }
}