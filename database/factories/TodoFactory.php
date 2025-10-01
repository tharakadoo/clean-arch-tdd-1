<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Todo;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => 'pending',
        ];
    }
}
