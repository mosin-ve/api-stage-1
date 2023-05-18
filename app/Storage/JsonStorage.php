<?php

namespace App\Storage;

use Exception;

class JsonStorage implements \App\Interfaces\StorageInterface
{
    private string $storagePath;

    public function __construct($storagePath)
    {
        $this->storagePath = $storagePath;
    }

    public function write(mixed $data): mixed
    {
        return file_put_contents($this->storagePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function read(): mixed
    {
        return json_decode(file_get_contents($this->storagePath), true);
    }

    public function update(mixed $data = null, string $index = ''): array
    {
        $todos = $this->read();
        $todosIds = array_column($todos, 'id');

        $key = array_search($index, $todosIds);
        if($key == false && $key != 0) {
            throw new Exception('Todo not found');
        }

        $todo = $todos[$key];
        $todo = array_merge($todo, $data);

        if($todo['completed'] == "1") {
            $todo['completed'] = true;
        }

        if($todo['completed'] == "0") {
            $todo['completed'] = false;
        }

        $todos[$key] = $todo;
        $this->write($todos);
        return $todo;
    }

    public function search($key, $value): mixed
    {
        $todos = $this->read();
        $todoKeys = array_column($todos, $key);

        $key = array_search($value, $todoKeys);
        if($key == false && $key != 0) {
            throw new Exception('Todo not found');
        }
        return $todos[$key];
    }

    public function delete(string $index)
    {
        $todos = $this->read();
        $todosIds = array_column($todos, 'id');

        $key = array_search($index, $todosIds);

        if($key == false && $key != 0) {
            throw new Exception();
        }

        unset($todos[$key]);
        $this->write($todos);
    }
}