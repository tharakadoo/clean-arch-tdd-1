<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Todo as TodoModel;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_todo()
    {
        $response = $this->postJson('/api/todos', [
            'title' => 'My first todo',
            'description' => 'Learn TDD in Laravel',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'title' => 'My first todo',
                'status' => 'pending',
            ]);
    }

    public function test_can_fetch_all_todos()
    {
        // Arrange: create some todos
        TodoModel::factory()->create(['title' => 'Todo 1', 'status' => 'pending']);
        TodoModel::factory()->create(['title' => 'Todo 2', 'status' => 'done']);

        // Act: hit the API endpoint
        $response = $this->getJson('/api/todos');

        // Assert
        $response->assertStatus(200)
            ->assertJsonCount(2) // should return 2 todos
            ->assertJsonFragment(['title' => 'Todo 1'])
            ->assertJsonFragment(['title' => 'Todo 2']);
    }

    public function test_can_update_todo()
    {
        $todo = \App\Models\Todo::factory()->create([
            'title' => 'Old Title',
            'description' => 'Old description',
            'status' => 'pending',
        ]);

        $response = $this->patchJson("/api/todos/{$todo->id}", [
            'title' => 'New Title',
            'description' => 'New description',
            'status' => 'done',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment([   // ✅ safer than full assertJson
                'title' => 'New Title',
                'description' => 'New description',
                'status' => 'done',
            ]);

        // Extra check in DB
        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'New Title',
                'description' => 'New description',
                'status' => 'done',
            ]);
    }

    public function test_can_delete_todo()
    {
        // Arrange: create a todo in the database
        $todo = Todo::factory()->create();

        // Act: call the DELETE API
        $response = $this->deleteJson('/api/todos/' . $todo->id);

        // Assert: response JSON
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted successfully',
            ]);

        // Assert: database no longer has this todo
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }

    public function test_cannot_delete_non_existing_todo()
    {
        // Act: delete an ID that doesn't exist
        $response = $this->deleteJson('/api/todos/999');

        // Assert: should return 404 with message
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Todo not found',
            ]);
    }

}
