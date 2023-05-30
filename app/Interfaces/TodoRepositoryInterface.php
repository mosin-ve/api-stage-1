<?php

namespace App\Interfaces;

use App\Models\Todo;

interface TodoRepositoryInterface
{
    /**
     * @return Todo[]
     */
    public function get_all(): array;

    public function get_by_id(int $id): Todo;

    public function add(mixed $data): Todo;

    public function update(int $id, mixed $data): Todo|bool;

    public function delete($id);
}
