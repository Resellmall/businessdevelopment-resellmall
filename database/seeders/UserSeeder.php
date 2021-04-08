<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Psr7\str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> str::random(10),            
            'mobile' => str::random(10),
            'email' => str::random(10).'@resellmall.com',            
            'password' => Hash::make('12345678'),
            'role_id' => '9',
            'user_status' => '1'
        ]);
    }
}
