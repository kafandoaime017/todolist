<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class TodoListIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_full_todo_flow()
    {
        $userResponse = $this->postJson('/api/users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@test.com',
            'password' => 'Password1',
            'age' => 20,
        ]);

        $userResponse->assertStatus(201);
        $userId = $userResponse->json('id');

        $todoResponse = $this->postJson('/api/todo-lists', [
            'user_id' => $userId,
        ]);

        $todoResponse->assertStatus(201);
        $todoId = $todoResponse->json('id');

        $itemResponse = $this->postJson('/api/items', [
            'todo_list_id' => $todoId,
            'name' => 'Task 1',
            'content' => 'My content',
        ]);

        $itemResponse->assertStatus(201);

        $this->assertDatabaseHas('items', [
            'name' => 'Task 1'
        ]);
    }
}