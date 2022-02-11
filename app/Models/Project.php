<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users() {
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function boards()
    {
        return $this->hasMany(Board::class)->orderBy('order');
    }


    public function getOwner() {
        foreach($this->users as $user) {
            if($user->pivot['role'] == 'Owner') 
                return $user;
        }
    }
}
