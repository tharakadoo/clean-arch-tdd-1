<?php

namespace Tests\Unit;

use App\Entities\Todo;
use App\UseCases\CreateTodo;
use App\Interfaces\TodoRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Todo as TodoModel;
use App\UseCases\DeleteTodo;
use App\UseCases\GetTodos;
use App\UseCases\UpdateTodo;

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

    public function test_it_returns_all_todos()
    {
        $todos = [
            new Todo('Todo 1', null, 'pending'),
            new Todo('Todo 2', null, 'done'),
        ];

        $mockRepo = $this->createMock(TodoRepositoryInterface::class);
        $mockRepo->expects($this->once())
            ->method('all')
            ->willReturn($todos);

        $useCase = new GetTodos($mockRepo);
        $result = $useCase->execute();

        $this->assertCount(2, $result);
        $this->assertEquals('Todo 1', $result[0]->title);
        $this->assertEquals('Todo 2', $result[1]->title);
    }

    public function test_it_updates_a_todo()
    {
        $updatedTodo = new TodoModel([
            'id' => 1,
            'title' => 'Updated Title',
            'description' => 'Updated description',
            'status' => 'done'
        ]);

        $mockRepo = $this->createMock(TodoRepositoryInterface::class);
        $mockRepo->expects($this->once())
            ->method('update')
            ->with(1, [
                'title' => 'Updated Title',
                'description' => 'Updated description',
                'status' => 'done'
            ])
            ->willReturn($updatedTodo);

        $useCase = new UpdateTodo($mockRepo);
        $result = $useCase->execute(1, [
            'title' => 'Updated Title',
            'description' => 'Updated description',
            'status' => 'done'
        ]);

        $this->assertEquals('Updated Title', $result->title);
        $this->assertEquals('Updated description', $result->description);
        $this->assertEquals('done', $result->status);
    }

    public function test_it_deletes_a_todo()
    {
        $mockRepo = $this->createMock(TodoRepositoryInterface::class);
        $mockRepo->expects($this->once())
            ->method('delete')
            ->with(1)
            ->willReturn(true);

        $useCase = new DeleteTodo($mockRepo);
        $result = $useCase->execute(1);

        $this->assertTrue($result);
    }

    public function test_it_returns_false_if_todo_not_found()
    {
        $mockRepo = $this->createMock(TodoRepositoryInterface::class);
        $mockRepo->expects($this->once())
            ->method('delete')
            ->with(999)
            ->willReturn(false);

        $useCase = new DeleteTodo($mockRepo);
        $result = $useCase->execute(999);

        $this->assertFalse($result);
    }
}
