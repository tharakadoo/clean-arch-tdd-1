<?php

namespace App\Repositories;

use App\Entities\Todo as TodoEntity;
use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;

class EloquentTodoRepository implements TodoRepositoryInterface
{
    public function create(TodoEntity $todo): Todo
    {
        return Todo::create([
            'title' => $todo->title,
            'description' => $todo->description,
            'status' => $todo->status,
        ]);
    }
}
