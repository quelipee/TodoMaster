<?php

namespace App\TodoList;

use App\TodoList\Models\TodoList;

class TODOFactory
{
    public static function make(TodoListDTO $DTO): TodoList
    {
        $todo = new TodoList([
            'title' => $DTO->title,
            'description' => $DTO->description,
            'status' => $DTO->status,
        ]);

        $todo->save();
        return $todo;
    }
}
