<?php

namespace App\Storage;

use App\Interfaces\StorageInterface;
use Exception;

const DATA_SOURCE = 'data.json';
class JsonStorage
{
    private string $json_file;
    public mixed $stored_data;
    public int $number_of_records;

    public function __construct($file_path)
    {
        $this->json_file = $file_path;
        $this->stored_data = json_decode(file_get_contents($this->json_file), true);
        $this->number_of_records = count($this->stored_data);
    }


    public function write(mixed $data): false|int
    {
        return file_put_contents(DATA_SOURCE, json_encode($data));
    }

    public function read()
    {
        return json_decode(file_get_contents(DATA_SOURCE), true);
    }

    public function update(mixed $data = null, int $index = -1): void
    {
        $key = array_search($index, array_keys($this->stored_data));
        if (!$key){
            throw new Exception();
        }
        foreach ($this->stored_data as $stored_data) {
            if ($stored_data['null,int'] == $data) {
                continue;
            }
        }
    }

    public function search($key, $value): void
    {
        foreach (($this->stored_data) as $key => $stored_data) if ($stored_data['null, int'] = $value) {
            continue;
        }
    }

    public function delete(int $index): void
    {
        foreach ($this->stored_data as $key => $stored_data) {
            if ($stored_data['int'] == $index) {
                unset($this->stored_data[$key]);
            }
        }
    }
}