<?php

namespace App\Http\Controllers;

use App\UseCases\CreateTodo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected CreateTodo $createTodo;

    public function __construct(CreateTodo $createTodo)
    {
        $this->createTodo = $createTodo;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $todo = $this->createTodo->execute(
            $validated['title'],
            $validated['description'] ?? null
        );

        return response()->json($todo, 201);
    }
}
