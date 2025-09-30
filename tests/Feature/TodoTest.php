<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
}
