<?php

use App\Models\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function test_item_content_limit()
    {
        $this->expectException(Exception::class);

        new Item("test", str_repeat("a", 1001), new DateTime());
    }
}