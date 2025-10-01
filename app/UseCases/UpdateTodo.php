<?php

namespace App\UseCases;

use App\Interfaces\TodoRepositoryInterface;

class UpdateTodo
{
    protected $repository;

    public function __construct(TodoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }
}
