<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'task_id';

    protected $casts = [
        'due_date'    => 'datetime',
        'notified_at' => 'datetime',
    ];
    protected $fillable = [
        'title',
        'description',
        'completed',
        'priority',
        'due_date',
        'user_id',
        'category_id',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Tarefa pertence a uma categoria
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
