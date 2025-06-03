<?php

namespace App\TodoList;

use App\TodoList\Requests\TodoListRequest;

readonly class TodoListDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public string $status,
    ){}

    public static function FromValidatedRequest(TodoListRequest $request): TodoListDTO
    {
        return new self(
            title: $request->validated(['title']),
            description: $request->validated(['description']),
            status: $request->validated(['status']),
        );
    }
}
