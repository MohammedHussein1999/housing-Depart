<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name'=>'Mohammed',
            'email'=> "tttt@tttt.com",
            'password'=>bcrypt('123456789'),
            'type'=>1,
        ]);

    }
}
