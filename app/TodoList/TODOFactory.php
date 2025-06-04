<?php

namespace App\TodoList;

use App\TodoList\Models\TodoList;
use Illuminate\Support\Facades\Auth;

class TODOFactory
{
    public static function make(TodoListDTO $DTO): TodoList
    {
//        dd(Auth::user());
        $todo = new TodoList([
            'title' => $DTO->title,
            'description' => $DTO->description,
            'status' => $DTO->status,
        ]);
        $todo->user()->associate(Auth::user());
        $todo->save();
        return $todo;
    }

    public static function update(TodoListDTO $DTO, TodoList $todo): TodoList
    {
        $todo->fill([
            'title' => $DTO->title,
            'description' => $DTO->description,
            'status' => $DTO->status,
        ]);
        $todo->user()->associate(Auth::user());
        $todo->save();
        return $todo;
    }
}
