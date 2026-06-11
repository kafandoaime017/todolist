<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\TodoList;

class TodoListTest extends TestCase
{
    public function test_todolist_belongs_to_user()
    {
        $user = User::factory()->create();

        $todo = TodoList::create([
            'user_id' => $user->id
        ]);

        $this->assertEquals($user->id, $todo->user->id);
    }

    public function test_todolist_has_items_relation()
    {
        $user = User::factory()->create();

        $todo = TodoList::create([
            'user_id' => $user->id
        ]);

        $this->assertTrue(method_exists($todo, 'items'));
    }
}