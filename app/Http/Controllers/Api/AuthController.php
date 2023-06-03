<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Traits\HttpResponses;
use App\Models\User;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error("", "Credentials do not match.", 401);
        }

        $user = Auth::user();
        $userRole = $user->role()->first();

        if ($userRole)
        {
            $this->scope = $userRole->role;
        }
    
        return $this->success([
            "user" => $user,
            "token" => $user->createToken('API Token of ' . $user->lastname . ', ' . $user->firstname, [$this->scope])->accessToken,
            "role" => $userRole->role
        ]);
    }

    public function register(StoreUserRequest $request) 
    {
        $request->validated($request->all());

        $user = User::create([
            'user_id' => $request->user_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        // Command for registering agent
        // $department = Department::find(1);
        // $department->users()->attach($user->id);

        // Command for attaching roles
        $role = new \App\Models\Role(['role' => 'Client']);
        $user->role()->save($role);

        return $this->success([
            'user' => $user,
            'token' =>  $user->createToken("API Token of " . $user->lastname . ', ' . $user->firstname, ['Client'])->accessToken,
            'role' => $user->role->role
        ]);        
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->success(null, "You have been log out successfully.");
    }
}
