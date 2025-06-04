<?php

namespace App\TodoList;

interface TodoListContracts
{
    public function newTodo(TodoListDTO $DTO);

    public function updatedTodo(TodoListDTO $DTO, string $id);
}
