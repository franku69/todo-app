<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'table_todo'; // Specify the custom table name
    protected $fillable = [
        'task', 'value', 'description'
    ];
}
