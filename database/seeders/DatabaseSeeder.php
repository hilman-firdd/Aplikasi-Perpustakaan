<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);

        User::create([
            'username' => 'admin',
            'slug' => 'buku-test',
            'password' => bcrypt('password'),
            'phone' => '081829182',
            'address' => 'address test',
            'status' => 'active',
            'role_id' => 1
        ]);

        User::create([
            'username' => 'client',
            'slug' => 'buku-test',
            'password' => bcrypt('password'),
            'phone' => '081829182',
            'address' => 'address test',
            'status' => 'active',
            'role_id' => 2
        ]);
    }
}
