<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Storage\JsonStorage;
use Exception;
use Psy\Util\Json;

class TodoRepository implements \App\Interfaces\TodoRepositoryInterface
{
    private JsonStorage $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    /**
     * @inheritDoc
     */
    public function get_all(): array
    {
        return $this->storage->read();
    }

    public function get_by_id($id): Todo|bool
    {
        try {
            $todo = $this->storage->search('id', $id);
        } catch (Exception $exception) {
            return false;
        }

        $model = new Todo;

        $model->set_id($todo['id']);
        $model->set_description($todo['description']);
        $model->set_completed($todo['completed']);

        return $model;
    }

    public function add(mixed $data)
    {
        $model = new Todo;
        $id = uniqid();

        $model->set_id($id);
        $model->set_description($data['description']);
        $model->set_completed($data['completed']);

        $todos = $this->storage->read();
        $todos[] = $model;
        $this->storage->write($todos);

        return $model;

    }

    public function update(string $id, mixed $data): Todo|bool
    {
        try {
            $todo = $this->storage->update($data, $id);
        } catch (Exception $exception) {
            return false;
        }
        $model = new Todo;

        $model->set_id($todo['id']);
        $model->set_description($todo['description']);
        $model->set_completed($todo['completed']);

        return $model;
    }

    public function delete($id): bool
    {
        try {
            $this->storage->delete($id);
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}