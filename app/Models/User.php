<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'age',
    ];

    public function todoList()
    {
        return $this->hasOne(TodoList::class);
    }

    public function isValid(): bool
    {
        return $this->isEmailValid()
            && !empty($this->first_name)
            && !empty($this->last_name)
            && $this->isPasswordValid()
            && $this->age >= 13;
    }

    private function isEmailValid(): bool
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function isPasswordValid(): bool
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,40}$/', $this->password);
    }
}