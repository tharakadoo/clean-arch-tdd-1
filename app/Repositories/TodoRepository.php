<?php

namespace App\Repositories;

use App\Interfaces\TodoRepositoryInterface;
use App\Entities\Todo;
use App\Models\Todo as TodoModel;

class TodoRepository implements TodoRepositoryInterface
{
    public function create(Todo $todo): TodoModel
    {
        return TodoModel::create([
            'title' => $todo->title,
            'status' => $todo->status,
        ]);
    }

    public function all()
    {
        return TodoModel::all();
    }

    public function find(int $id)
    {
        return TodoModel::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $todo = TodoModel::findOrFail($id);
        $todo->update($data);
        return $todo;
    }

    public function delete(int $id)
    {
        return TodoModel::destroy($id);
    }
}
