<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'09797957976',
            'address'=>'Mandalay',
            'role'=>'admin',
            'gender'=>'male',
            'password'=>Hash::make('admin123')
        ]);
        User::create([
            'name'=>'Dean',
            'email'=>'user@gmail.com',
            'phone'=>'09786024844',
            'address'=>'Yangon',
            'role'=>'user',
            'gender'=>'male',
            'password'=>Hash::make('user1234'),

        ]);
    }
}
