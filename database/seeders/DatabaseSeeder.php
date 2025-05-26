<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        
        User::factory()->create([
            'name' => 'Test Kasutaja',
            'email' => 'test@test.ee',
            'password' => Hash::make('test@test.ee'),
        
        ]);

        $this->call([
            PublicationTypeSeeder::class,
            LanguageSeeder::class,
            AuthorSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
    
        ]);

    }
}
