<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // // to create Admin
        // $user = User::create([
        //     'user_id' => '11111',
        //     'firstname' => 'Admin',
        //     'lastname' => 'Admin',
        //     'email' => 'admin@testing.com',
        //     'password' => Hash::make('Admin1234!')
        // ]);

        // // Command for attaching roles
        // $role = new \App\Models\Role(['role' => 'Admin']);
        // $user->role()->save($role);

        // $this->scope = $role;

        // // to create Agent
    //     $user = User::create([
    //         'user_id' => '22222',
    //         'firstname' => 'Agent',
    //         'lastname' => 'Agent',
    //         'email' => 'agent@testing.com',
    //         'password' => Hash::make('agent1234!')
    //     ]);

    //      // Command for registering agent
    //     $department = Department::find(1);
    //     $department->users()->attach($user->id);


    //     // Command for attaching roles
    //     $role = new \App\Models\Role(['role' => 'Agent']);
    //     $user->role()->save($role);

    //     $this->scope = $role;
       
    }
}
