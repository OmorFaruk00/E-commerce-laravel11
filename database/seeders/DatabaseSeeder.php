<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Roleable;
use App\Models\RoleUser;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\UserRole;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'su',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
            ],
        ];
        
        foreach ($roles as $role) {
            Role::create($role);
        }

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' =>bcrypt('admin@1234'),
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' =>bcrypt('user@1234'),
            ],
        ];
        
        foreach ($users as $user) {
            User::create($user);
        }

        $user_role = [
            [
                'user_id' => 1,
                'role_id' => 1,
               
            ],
            [
                'user_id' => 2,
                'role_id' => 2,
            ],
        ];
        foreach ($user_role  as $user) {
            UserRole::create($user);
        }


        $roleable = [
            [
                'role_id' => 1,
                'roleable_type' => 'App\Models\User',
                'roleable_id' => 1,
               
            ],
            [
                'role_id' => 2,
                'roleable_type' => 'App\Models\User',
                'roleable_id' => 2,
               
            ],
            [
                'role_id' => 1,
                'roleable_type' => 'App\Models\User',
                'roleable_id' => 2,
               
            ],
        ];

        foreach ($roleable  as $role) {
            Roleable::create($role);
        }


        SystemSetting::factory()->create([
            'key' => 'session_expired_time',
            'value' => '36000',
        ]);


        \App\Models\Category::factory(100)->create();
    }
}
