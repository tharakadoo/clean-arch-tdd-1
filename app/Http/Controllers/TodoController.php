<?php

namespace App\Http\Controllers;

use App\UseCases\CreateTodo;
use App\UseCases\DeleteTodo;
use Illuminate\Http\Request;
use App\UseCases\GetTodos;
use App\UseCases\UpdateTodo;

class TodoController extends Controller
{
    protected CreateTodo $createTodo;

    public function __construct(CreateTodo $createTodo)
    {
        $this->createTodo = $createTodo;
    }

    public function index(GetTodos $getTodos)
    {
        return response()->json($getTodos->execute());
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

    public function update($id, Request $request, UpdateTodo $updateTodo)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'status' => 'sometimes|boolean',
        ]);

        $todo = $updateTodo->execute($id, $data);
        return $todo
            ? response()->json($todo)
            : response()->json(['message' => 'Todo not found'], 404);
    }

    public function destroy($id, DeleteTodo $deleteTodo)
    {
        return $deleteTodo->execute($id)
            ? response()->json(['message' => 'Deleted successfully'])
            : response()->json(['message' => 'Todo not found'], 404);
    }
}
