<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'completed',
        'priority',
        'due_date',
        'user_id',
        'category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tarefa pertence a uma categoria
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
