<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
   protected $fillable = [
    'user_id',
    'route',
    'time',
   ];
}
