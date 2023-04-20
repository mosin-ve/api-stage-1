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

    $todoes = read_data();

    $newTodo = array_merge($blank_todo, $todoData);
    $newTodo['id'] = uniqid();

    $todoes[] = $newTodo;

    write_data($todoes);

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
}

/**
 * Read item by id
 *
 * @param $todoId
 * @return void
 */
function readTodo($todoId) {

}


/**
 * Delete item
 *
 * @param $todoId
 * @return bool
 */
function deleteTodo($todoId) {
}
