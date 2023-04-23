<?php
require_once 'storage.php';

$blank_todo = [
    'id' => 0,
    'description'=> '',
    'completed' => "0"
];

/**
 * Read list of items
 *
 * @return array
 */
function listTodo(): array {
    return read_data();
}

/**
 * Create and return item
 *
 * @param $todoData mixed
 * @return mixed
 */
function createTodo (mixed $todoData): mixed {
    global $blank_todo;
    $todos = read_data();
    $newTodo = array_merge($blank_todo, $todoData);
    $newTodo['id'] = uniqid();
    $todos[] = $newTodo;
    write_data($todos);
    return $newTodo;
}

/**
 * Edit and return item by id
 *
 * @param $todoId
 * @param $todoData
 * @return mixed
 */
function editTodo($todoId, $todoData) {
    $todos = $listTodo();
    $key = array_search($todoId, array_column($todos,  'id'));
    $newTodo = array_merge($todos[$key], $todoData);
    $todos[$key] = $newTodo;
    write_data($todos);
    return $newTodo;
}

/**
 * Read item by id
 *
 * @param $todoId
 * @return void
 */
function readTodo($todoId) {
    $todos = $listTodo();
    $key = array_search($todoId, array_column($todos,  'id'));
    if (array_key_exists($key, $todos)) {
        return $todos[$key];
    }
    return false;
}


/**
 * Delete item
 *
 * @param $todoId
 * @return bool
 */
function deleteTodo($todoId)
{
    $todos = $listTodo();
    $key = array_search($todoId, array_column($todos, 'id'));
    if ($key = false) {
        unset($todos[$key]);
        write_data($todos);
        return true;
    }
    return false;
        }
