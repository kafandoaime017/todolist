<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_list_id',
        'name',
        'content',
        'created_at'
    ];

    public $timestamps = false;

    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }

   protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            if (strlen($item->content ?? '') > 1000) {
                throw new \InvalidArgumentException("Content too long");
            }
        });
    }
}