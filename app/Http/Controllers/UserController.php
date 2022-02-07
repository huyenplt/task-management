<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user) {
        return view('users.profile', [
            'user'=>$user,
        ]);
    }

    public function update(User $user) {
        $inputs = request()->validate([
            'name' =>['required', 'string', 'max:255'],
            'email' =>['required', 'string', 'max:255'],
            'avatar' =>['file'],
        ]);
        if(request('avatar')) {
            $inputs['avatar'] = request('avatar')->store('images');
        }
        $user->update($inputs);

        return back();
    }
}
