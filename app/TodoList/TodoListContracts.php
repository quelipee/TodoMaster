<?php

namespace App\TodoList;

interface TodoListContracts
{
    public function newTodo(TodoListDTO $DTO);
}
