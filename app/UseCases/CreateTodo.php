<?php

namespace App\UseCases;

use App\Entities\Todo as TodoEntity;
use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;

class CreateTodo
{
    protected TodoRepositoryInterface $repository;

    public function __construct(TodoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $title, ?string $description = null): Todo
    {
        $todoEntity = new TodoEntity($title, $description);
        return $this->repository->create($todoEntity);
    }
}
