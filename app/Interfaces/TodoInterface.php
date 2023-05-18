<?php

namespace App\Interfaces;

interface TodoInterface
{
    /**
     * @return float
     */
    public function get_id(): string;

    /**
     * @param float $id
     */
    public function set_id(string $id): void;

    /**
     * @return string
     */
    public function get_description(): string;

    /**
     * @param string $description
     */
    public function set_description(string $description): void;

    /**
     * @return bool
     */
    public function is_completed(): bool;

    /**
     * @param bool $completed
     */
    public function set_completed(bool $completed): void;
}
