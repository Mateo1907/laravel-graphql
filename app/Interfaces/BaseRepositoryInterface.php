<?php

namespace App\Interfaces;

interface BaseRepositoryInterface
{
    public function all();
    public function find(string $id);
    public function create(array $payload);
    public function update(array $payload);
    public function delete(string $id);
}