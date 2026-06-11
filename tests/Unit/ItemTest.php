<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Item;
use InvalidArgumentException;

class ItemTest extends TestCase
{
    public function test_item_can_be_created_with_valid_content()
    {
        $item = new Item([
            'todo_list_id' => 1,
            'name' => 'Task 1',
            'content' => 'Valid content',
        ]);

        $this->assertEquals('Task 1', $item->name);
        $this->assertEquals('Valid content', $item->content);
    }

   public function test_item_content_too_long_throws_exception()
    {
        $this->expectException(\InvalidArgumentException::class);

        \App\Models\Item::create([
            'todo_list_id' => 1,
            'name' => 'Task',
            'content' => str_repeat('a', 1001),
        ]);
    }
}