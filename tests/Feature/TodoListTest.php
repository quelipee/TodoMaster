<?php

namespace Tests\Feature;

use App\TodoList\Models\TodoList;
use App\TodoList\Status;
use Database\Factories\TodoFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_todo()
    {
        $payload = [
            'title' => fake()->title(),
            'description' => fake()->text(),
            'status' => Status::Completed->value,
        ];
        $response = self::post('/todolist', $payload);
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
    }

    public function test_can_list_all_todos()
    {
        TodoList::factory(10)->create();
    }
}
