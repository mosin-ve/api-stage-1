<?php

namespace App\Interfaces;

interface StorageInterface
{
    public function write(mixed $data);
    public function read();
    public function update(mixed $data = null, string $index = '');
    public function search($key, $value);

    public function delete(string $index);
}
