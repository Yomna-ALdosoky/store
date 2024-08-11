<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'yomna',
            'email'=>'yomnadosoky@gmail.com',
            'password'=> Hash::make('password'),
            'phome_number'=>'1233123',
        ]);


        DB::table('users')->insert([
            'name'=>'ahmed',
            'email'=>'ahmed@gmail.com',
            'password'=> Hash::make('password'),
            'phome_number'=>'1233454',
        ]);
    }
}