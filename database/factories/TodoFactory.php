<?php

namespace Database\Factories;

use App\TodoList\Models\TodoList;
use App\TodoList\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<TodoList>
 */
class TodoFactory extends Factory
{
    protected $model = TodoList::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'status' => Arr::random([Status::Completed->value, Status::Pending->value]),
        ];
    }
}
