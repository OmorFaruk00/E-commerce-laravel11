<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Roleable;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RoleUser;
use App\Models\UserRole;
use App\Models\SystemSetting;
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


        // \App\Models\Category::factory(10)->create();
        \App\Models\Brand::factory(10)->create();
         // Create categories and tags
         $categories = Category::factory(10)->create(); // Create 10 categories
         $tags = Tag::factory(5)->create(); // Create 5 tags
         
         // Create products and attach categories and tags
         Product::factory(100) // Create 100 products
             ->create()
             ->each(function ($product) use ($categories, $tags) {
                 // Attach 2 random categories to each product
                 $product->categories()->attach(
                     $categories->random(2)->pluck('id')->toArray()
                 );
 
                 // Attach 3 random tags to each product
                 $product->tags()->attach(
                     $tags->random(3)->pluck('id')->toArray() // Attach 3 random tags
                 );
             });
    }
}
