<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_done',
        'user_id',
    ];


    // task pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
