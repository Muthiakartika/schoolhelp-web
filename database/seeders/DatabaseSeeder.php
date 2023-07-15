<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        DB::table('users')->insert([
            'rule' => 'schoolHelp',
            'username' => 'schoolhelp',
            'email' => 'schoolhelp@gmail.com',
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'password' => Hash::make('schoolhelp123'),
            'fullname' => 'School HELP',
            'phone' => '0327162000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('schools')->insert([
            'schoolName' => 'HELP Univeristy',
            'schoolAddress' => 'Subang',
            'schoolCity' => 'Kuala Lumpur',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('schools')->insert([
            'schoolName' => 'ITB STIKOM BALI',
            'schoolAddress' => 'Renon',
            'schoolCity' => 'Denpasar',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
