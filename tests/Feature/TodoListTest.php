<?php

namespace Tests\Feature;

use App\Models\User;
use App\TodoList\Models\TodoList;
use App\TodoList\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    protected User|Collection|Model $user;
    protected function setUp(): void {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

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
        $response = self::get('/todolist');
        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_can_use_filter_by_status()
    {
        TodoList::factory()->create([
            'status' => Status::Completed->value
        ]);
        TodoList::factory()->create([
            'status' => Status::Pending->value
        ]);

        $response = self::get('/todolist?status=Completed');
        $response->assertStatus(ResponseAlias::HTTP_OK);
        $response->assertSee('Completed');
        $response->assertDontSee('Pending');

        $response = self::get('/todolist?status=Pending');
        $response->assertStatus(ResponseAlias::HTTP_OK);
        $response->assertSee('Pending');
        $response->assertDontSee('Completed');
    }

    public function test_can_update_todo()
    {
        $payload = [
            'title' => 'nao tem titulo',
            'description' => fake()->text(),
            'status' => Status::Pending->value,
        ];
        $todoId = TodoList::factory()->create(['id' => 1])->id;

        $response = self::put('/todolist/' . $todoId, $payload);
        $response->assertStatus(ResponseAlias::HTTP_FOUND);

        $this->assertDatabaseHas('tasks', [
            'title' => 'nao tem titulo',
            'description' => $payload['description'],
            'status' => Status::Pending->value,
        ]);

    }

    public function test_can_deleted_with_soft_delete()
    {
        $user = User::factory()->create();
        $todo = TodoList::factory(10)->create()->last();

        $response = self::delete('/todolist/' . $todo->id);
        $response->assertStatus(ResponseAlias::HTTP_NO_CONTENT);
        $this->assertSoftDeleted('tasks', ['id' => $todo->id]);
    }

}
