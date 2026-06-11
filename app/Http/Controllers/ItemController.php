<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\TodoList;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(TodoList $todoList, Request $request)
    {
        // MAX 10 ITEMS
        if ($todoList->items()->count() >= 10) {
            return response()->json([
                'error' => 'Max 10 items reached'
            ], 400);
        }

        // 30 MIN RULE
        $lastItem = $todoList->items()->latest()->first();

        if ($lastItem) {
            $diff = now()->diffInMinutes($lastItem->created_at);

            if ($diff < 30) {
                return response()->json([
                    'error' => 'Wait 30 minutes between items'
                ], 400);
            }
        }

        $item = Item::create([
            'todo_list_id' => $todoList->id,
            'name' => $request->name,
            'content' => $request->content,
            'created_at' => now()
        ]);

        // EMAIL À 8 ITEMS
        if ($todoList->items()->count() === 8) {
            app(\App\Services\EmailSenderService::class)->send(
                $todoList->user->email,
                "Votre TodoList est presque pleine"
            );
        }

        return response()->json($item, 201);
    }
}