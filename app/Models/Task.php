<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'order', 
        'board_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function boards()
    {
        return $this->belongsTo(Board::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
