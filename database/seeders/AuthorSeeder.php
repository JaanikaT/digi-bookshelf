<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        DB::table('authors')->insert([
            ['author' => 'John Doe','created_at' => now(), 'updated_at' => now()],
            ['author' => 'Jane Smith', 'created_at' => now(), 'updated_at' => now()],
            ['author' => 'Mark Twain', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}