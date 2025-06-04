<?php

namespace App\TodoList\Models;

use App\Models\User;
use App\TodoList\Status;
use Database\Factories\TodoFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail(string $id)
 */
class TodoList extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

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

    protected static function newFactory(): TodoFactory|Factory
    {
        return TodoFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
