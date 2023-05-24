<?php

namespace App\Interfaces;

use App\Models\Todo;

interface TodoRepositoryInterface
{
    /**
     * @return Todo[]
     */
    public function get_all(): array;

    public function get_by_id($id): Todo|bool;

    public function add(mixed $data);

    public function update(string $id, mixed $data): Todo|bool;

    public function delete($id): bool;
}
