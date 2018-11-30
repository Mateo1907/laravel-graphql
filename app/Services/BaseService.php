<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseService
{
    public function all() : Collection
    {
        return $this->repository->all();
    }

    public function paginate($items, $total, $perPage, $currentPage = null, $options = []) : LengthAwarePaginator
    {
        return $this->repository->paginate($items, $total, $perPage, $currentPage, $options);
    }

    public function where(array $payload) : Collection 
    {
        return $this->repository->where($payload);
    }

    public function create(array $payload) : Model
    {
        return $this->repository->create($payload);
    }
}