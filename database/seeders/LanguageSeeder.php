<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        $languages = [
            ['language' => 'eesti', 'language_code' => 'et'],
            ['language' => 'inglise', 'language_code' => 'en'],
            ['language' => 'vene', 'language_code' => 'ru'],
            ['language' => 'soome', 'language_code' => 'fi'],
            ['language' => 'saksa', 'language_code' => 'de'],
            ['language' => 'prantsuse', 'language_code' => 'fr'],
            ['language' => 'hispaania', 'language_code' => 'es'],
            
        ];

        foreach ($languages as $lang) {
            DB::table('languages')->insert([
                'language' => $lang['language'],
                'language_code' => $lang['language_code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}