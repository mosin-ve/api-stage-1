<?php
 namespace App\Models;
 use App\Interfaces\TodoInterface;
 use App\Storage\JsonStorage;

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
 class Todo implements TodoInterface
 {
     private $id;
     private $description;
     private $completed;

     public function toArray()
     {
         return [
             'id' => $this->id,
             'description' => $this->description,
             'completed' => $this->completed,
         ];
     }
        public function get_id(): float
    {
        return $this->id;
    }

    /**
     * @param float $id
     */
    public function set_id(float $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function get_description(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function set_description(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function is_completed(): bool
    {
        return $this->completed;
    }

    /**
     * @param bool $completed
     */
    public function set_completed(bool $completed): void
    {
        $this->completed = $completed;
    }


 }

