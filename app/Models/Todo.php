<?php

namespace App\Models;

use App\Interfaces\TodoInterface;



class Todo implements TodoInterface
{

    private float $id;
    private string $description;
    private bool $completed = false;


    public function get_id(): float
    {
        return $this->id;
    }

    public function set_id(float $id): void
    {
        $this->id = $id;
    }

    public function get_description(): string
    {
      return $this->description;
    }

    public function set_description(string $description): void
    {
        $this->description = $description;
    }

    public function is_completed(): bool
    {
        return $this->completed;
    }

    public function set_completed(bool $completed): void
    {
        $this->completed = $completed;
    }
}