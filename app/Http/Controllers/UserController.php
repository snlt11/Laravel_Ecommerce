<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $phone = $request->input('phone');
        $password = $request->input('password');
        $user = User::where('phone', $phone)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                auth()->login($user);
                return redirect()->route('admin.home')->with('info', $request->get('rememberMe') ?? 'off');
            } else {
                return redirect()->back()->with('error', 'Password is incorrect');
            }
        } else {
            return redirect()->back()->with('error', 'Credentials Error');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function test()
    {
        // $role = new Role();
        // $role->name = 'tester';
        // $role->save();
        // $user = auth()->user();
        // $user->roles()->attach(2);
        // $user->roles()->detach(2);
        // dd($user->roles->toArray());
        // foreach ($user->roles as $role) {
        // echo $role->name;
        // }

        // $user =  auth()->user();
        // if ($user->hasRole('SuperUser')) {
        //     echo "User Exists";
        // } else {
        //     echo "No User";
        // }

        $role = Role::all();
        dd($role[0]->users->toArray());
    }
}
