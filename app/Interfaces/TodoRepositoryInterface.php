<?php

namespace App\Interfaces;

use App\Entities\Todo;
use App\Models\Todo as TodoModel;

interface TodoRepositoryInterface
{
    public function create(Todo $todo): TodoModel;
}
