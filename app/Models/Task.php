<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Task extends Model
{
    public $fillable = ['title', 'description', 'is_completed'];
    
}
