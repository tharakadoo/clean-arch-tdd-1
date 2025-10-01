<?php

namespace App\Interfaces;

use App\Entities\Todo;
use App\Models\Todo as TodoModel;

interface TodoRepositoryInterface
{
    public function create(Todo $todo): TodoModel;
    public function all();
    public function update(int $id, array $data): ?TodoModel;
    public function delete(int $id): bool;
}
