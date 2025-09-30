<?php

namespace Tests\Unit;

use App\Entities\Todo;
use App\UseCases\CreateTodo;
use App\Interfaces\TodoRepositoryInterface;
use PHPUnit\Framework\TestCase;

class CreateTodoTest extends TestCase
{
    public function test_it_creates_a_todo()
    {
        $mockRepo = $this->createMock(TodoRepositoryInterface::class);
        $mockRepo->expects($this->once())
            ->method('create')
            ->willReturn(new \App\Models\Todo(['title' => 'Test', 'status' => 'pending']));

        $useCase = new CreateTodo($mockRepo);
        $todo = $useCase->execute('Test');

        $this->assertEquals('Test', $todo->title);
    }
}
