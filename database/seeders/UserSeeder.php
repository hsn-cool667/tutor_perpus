<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username'  => 'admin',
            'password'  =>  Hash::make('admin123'),
            'phone'     =>  '',
            'full_name' =>  'Husein',
            'address'   =>  'Sukoharjo',
            'status'    =>  'active',
            'role_id'   =>  '1'
        ]);
        DB::table('users')->insert([
            'username'  => 'husein',
            'password'  =>  Hash::make('admin123'),
            'phone'     =>  '',
            'full_name' =>  'Ahmad',
            'address'   =>  'Sukoharjo',
            'status'    =>  'active',
            'role_id'   =>  '3'
        ]);
        DB::table('users')->insert([
            'username'  => 'ahmad',
            'password'  =>  Hash::make('admin123'),
            'phone'     =>  '',
            'full_name' =>  'Zakariya',
            'address'   =>  'Sukoharjo',
            'status'    =>  'inactive',
            'role_id'   =>  '3'
        ]);
    }
}
