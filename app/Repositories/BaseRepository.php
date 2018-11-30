<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseRepositoryInterface
{
    public function all() : Collection
    {
        return $this->model::all();
    }

    public function find(string $id) : Model
    {
        return $this->model::find($id);
    }

    public function create(array $payload) : Model
    {
        return $this->model::create($payload);
    }

    public function update(array $payload) : Model
    {
        $this->model::update($payload);
        return $this->find($id);
    }

    public function delete(string $id) : bool
    {
        return $this->find($id)->delete();
    }

    public function where(array $payload) : Collection 
    {
        return $this->model::where($payload)->get();
    }

    public function paginate($items, $total, $perPage, $currentPage = null, array $options = []) : LengthAwarePaginator
    {
        return $this->model::paginate($items, $total, $perPage, $currentPage, $options);
    }
}