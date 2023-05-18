<?php

namespace App\Models;

class Todo implements \App\Interfaces\TodoInterface
{
    public string $id;
    public string $description;
    public bool $completed;

    /**
     * @inheritDoc
     */
    public function get_id(): string
    {
       return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function set_id(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @inheritDoc
     */
    public function get_description(): string
    {
        return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function set_description(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @inheritDoc
     */
    public function is_completed(): bool
    {
        return $this->completed;
    }

    /**
     * @inheritDoc
     */
    public function set_completed(bool $completed): void
    {
        $this->completed = $completed;
    }
}