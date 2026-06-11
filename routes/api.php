<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\ItemController;


Route::post('/users', [UserController::class, 'store']);
Route::post('/todo-lists', [TodoListController::class, 'store']);
Route::post('/items', [ItemController::class, 'store']);
Route::get('/todo-lists/{todoList}', [TodoListController::class, 'show']);