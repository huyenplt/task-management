<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function setPassWordAttribute($value) {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    public function getAvatarAttribute($value)
    {
        // return asset($value);
        return asset('storage/' . $value);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('role');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function userInProject($project)
    {
        foreach ($this->projects as $curProject) {
            if ($curProject->id == $project->id)
                return true;
        }
        return false;
    }

    public function countTaskDone() {
        $count = 0;
        foreach ($this->tasks as $task) {
            if($task->status == 1) 
                $count = $count+1;
        }
        return $count;
    }

}
