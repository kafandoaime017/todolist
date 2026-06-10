<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Item;
use App\Models\TodoList;
use App\Services\EmailSenderService;
use Mockery;
use PHPUnit\Framework\TestCase;
use DateTime;

class TodoListTest extends TestCase
{
    public function test_email_sent_at_8_items()
    {
        $emailMock = Mockery::mock(EmailSenderService::class);

        $emailMock->shouldReceive('send')
            ->once()
            ->with('test@test.com', 'Votre ToDoList est presque pleine');

        app()->instance(EmailSenderService::class, $emailMock);

        $user = new User("John", "Doe", "test@test.com", "Password1", 20);
        $list = new TodoList($user);

        for ($i = 1; $i <= 3; $i++) {
            $list->add(new Item(
                "iteme$i",
                "contente",
                new DateTime("+$i hours")
            ));
        }
    }
}
