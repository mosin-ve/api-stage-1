<?php

namespace App\Controllers;

use App\HttpRequest;
use App\JsonResponse;
use App\Models\Todo;
use App\Repositories\TodoRepository;

class TodoController
{
    private TodoRepository $repository;
    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Read list of items
     */
    public function listTodo(): void
    {
        JsonResponse::ok(array_map(fn (Todo $item) => $item->toArray(), $this->repository->get_all()) );
    }

    /**
     * Create and return item
     *
     * @param $todoData mixed
     */
    function createTodo (HttpRequest $request): void
    {
        if($this->middleware->checkIfMethodAllowed($request)) {
            JsonResponse::methodNotAllowed();
        } else {
            JsonResponse::created((array)$this->repository->add($request->get_body()));
        }

    }

    /**
     * Edit and return item by id
     *
     * @param HttpRequest $request
     */
    function editTodo(HttpRequest $request): void
    {
        if($this->middleware->checkIfMethodAllowed($request)) {
            JsonResponse:: methodNotAllowed();
        }
        elseif ($this->repository->update(intval($request->get_params()['id']), $request->get_body()) == false) {
            JsonResponse::notFound();
        } else {
            JsonResponse::ok($this->repository->update(intval($request->get_params()['id']), $request->get_body())->toArray());
        }
    }

    /**
     * Read item by id
     *
     * @param HttpRequest $request
     */
    function readTodo(HttpRequest $request): void
    {

        if ($this->repository->get_by_id($request->get_params()['id'])->toArray() == false) {
            JsonResponse::notFound();
        } else {
            JsonResponse::ok($this->repository->get_by_id($request->get_params()['id'])->toArray());
        }

    }

    /**
     * Delete item
     *
     * @param HttpRequest $request
     */
    function deleteTodo(HttpRequest $request): void
    {
        if ($this->repository->delete($request->get_params()['id'])) {
            JsonResponse::noContent();
        }
    }

}
