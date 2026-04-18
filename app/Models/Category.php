<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'name',
        'user_id',
        'description',
        'created_by',
        'updated_by'
    ];

    
    public function tasks(){
        return $this->hasMany(Task::class, 'category_id', 'category_id');
    }

    public function user()  {
        return $this->belongsTo(User::class);
    }
}
