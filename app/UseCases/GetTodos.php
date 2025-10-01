<?php

namespace App\UseCases;

use App\Interfaces\TodoRepositoryInterface;

class GetTodos
{
    protected $repository;

    public function __construct(TodoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute()
    {
        return $this->repository->all();
    }
}
