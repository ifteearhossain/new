<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'              => 'Farahnaz Ahmed',
            'email'             => 'ahmedfarahnaz1@gmail.com',
            'password'          =>  bcrypt(123456789),
            'user_role'         =>  0,
            'created_at'        => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);
        App\User::create([
            'name'              => 'Shiplu Rahman',
            'email'             => 'baadcoder@gmail.com',
            'password'          =>  bcrypt(123456789),
            'user_role'         =>  1,
            'created_at'        => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);

        App\User::create([
            'name'              => 'Maksudur Rahman',
            'email'             => 'spu.rahman@gmail.com',
            'password'          =>  bcrypt(123456789),
            'user_role'         =>  3,
            'created_at'        => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);

        App\User::create([
            'name'              => 'Rakyb Rahman',
            'email'             => 'rakyb@gmail.com',
            'password'          =>  bcrypt(123456789),
            'user_role'         =>  3,
            'created_at'        => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);

    }
}
