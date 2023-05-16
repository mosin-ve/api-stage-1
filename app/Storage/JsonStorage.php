<?php
 namespace App\Storage;

 use App\Interfaces\StorageInterface;

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


 class JsonStorage implements StorageInterface
 {
     public $data_source;
    public function __construct($data_source)
    {
        $this->data_source = $data_source;
    }

     public function write(mixed $data)
     {
         file_put_contents($this->data_source, json_encode($data));
     }
     public function read()
     {
         if (file_exists($this->data_source))
             {
                 return json_decode(file_get_contents($this->data_source), true);
             } else return 0;
     }
     public function update(mixed $data = null, int $index = -1)
     {
         $all_todos = $this->read();
         if (!empty($all_todos))
         {
             if ($index >= 100000000)
             {
               if ($data !== null)
               {
                   $all_todos[$index] = $data;
                   $this->write($all_todos);
                   return true;
               } else return false;
             } else return false;
         } return false;
     }
     public function search($key, $value)
     {
        $all_todos = $this->read();
        if (!empty($all_todos))
        {
            $current_key = array_search($key, array_column($all_todos, $key));
            if (in_array($current_key, $all_todos, true))
            {
                if ($all_todos[$current_key] == $value)
                {
                    return $all_todos[$current_key];
                } else return null;
            } else return null;
        } else return null;
     }
     public function delete(int $index)
     {
         $all_todos = $this->read();
         if (!empty($all_todos))
         {
             $current_id = array_search($index, array_column($all_todos, 'id'));
             if (in_array($current_id, $all_todos, true))
             {
                unset($all_todos[$current_id]);
                $this->write($all_todos);
                return true;
             } else return false;
         } else return false;
     }

 }