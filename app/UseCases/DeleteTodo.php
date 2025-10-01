<?php

namespace App\UseCases;

use App\Interfaces\TodoRepositoryInterface;
use App\Models\Todo;

class DeleteTodo
{
    protected $repository;

    public function __construct(TodoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
