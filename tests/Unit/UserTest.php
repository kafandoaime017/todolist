<?php

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_user_valid()
    {
        $user = new User("John", "Doe", "john@test.com", "Password1", 20);

        $this->assertTrue($user->isValid());
    }
}