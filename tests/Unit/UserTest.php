<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_user_is_valid()
    {
        $user = new User([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'john@test.com',
            'password'   => 'Password1',
            'age'        => 20,
        ]);

        $this->assertTrue($user->isValid());
    }

    public function test_user_invalid_email()
    {
        $user = new User([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'invalid',
            'password'   => 'Password1',
            'age'        => 20,
        ]);

        $this->assertFalse($user->isValid());
    }

    public function test_user_underage()
    {
        $user = new User([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'john@test.com',
            'password'   => 'Password1',
            'age'        => 10,
        ]);

        $this->assertFalse($user->isValid());
    }
}