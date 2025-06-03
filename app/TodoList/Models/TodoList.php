<?php

namespace App\TodoList\Models;

use App\TodoList\Status;
use Database\Factories\TodoFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoList extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'date',
        'status',
    ];

    protected $attributes = [
        'status' => Status::Completed->value,
    ];

    protected static function newFactory()
    {
        return TodoFactory::new();
    }

}
