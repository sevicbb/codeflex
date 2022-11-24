<?php

namespace App\Repositories;

abstract class Repository
{
    protected $model;

    public function all(array $eagerParams = [])
    {
        return $this->model::with($eagerParams)->get();
    }

    public function allWhere(string $field, $value, array $eagerParams = [])
    {
        return $this->model::where($field, $value)
            ->with($eagerParams)
            ->get();
    }

    public function allWhereNot(string $field, $value, array $eagerParams = [])
    {
        return $this->model::where($field, '!=', $value)
            ->orWhereNull($field)
            ->with($eagerParams)
            ->get();
    }

    public function find($id, array $eagerParams = [])
    {
        return $this->model::where('id', $id)
            ->with($eagerParams)
            ->first();
    }

    public function findBy(string $field, $value, array $eagerParams = [])
    {
        return $this->model::where($field, $value)
            ->with($eagerParams)
            ->first();
    }

    public function existsBy(string $field, $value)
    {
        return $this->model::where($field, $value)
            ->exists();
    }

    public function insert(array $data)
    {
        return $this->model::insert($data);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model::updateOrCreate($attributes, $values);
    }

    public function updateWhereConditions(array $conditions, array $values = [])
    {
        return $this->model::where($conditions)->update($values);
    }

    public function deleteAll()
    {
        return $this->model::query()->delete();
    }
}
