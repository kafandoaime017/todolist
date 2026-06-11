<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);

        if (!$user->isValid()) {
            return response()->json([
                'error' => 'User invalid'
            ], 400);
        }

        $todoList = TodoList::create([
            'user_id' => $user->id
        ]);

        return response()->json($todoList, 201);
    }

    public function show(TodoList $todoList)
    {
        return response()->json([
            'todoList' => $todoList,
            'items' => $todoList->items
        ]);
    }
}