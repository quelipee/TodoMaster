<?php

namespace App\TodoList\Services;

use App\TodoList\Models\TodoList;
use App\TodoList\TODOFactory;
use App\TodoList\TodoListContracts;
use App\TodoList\TodoListDTO;

class TodoListService implements TodoListContracts
{
    public function newTodo(TodoListDTO $DTO): TodoList
    {
        return TODOFactory::make($DTO);
    }

    public function updatedTodo(TodoListDTO $DTO, string $id): TodoList
    {
        $todo = TodoList::findOrFail($id);
        return TODOFactory::update($DTO,$todo);
    }
}
