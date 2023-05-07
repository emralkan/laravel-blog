<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('admins')->insert([
                'name'=>'emre',
                'email'=>'emralkaan7@gmail.com',
                'password'=>bcrypt(742662),
            ]);
        }
    }
