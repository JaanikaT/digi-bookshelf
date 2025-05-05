<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicationTypeSeeder extends Seeder
{
    public function run()
    {
        $types = ['Pehmekaaneline raamat', 'Kõvakaaneline raamat', 'E-raamat', 'Audioraamat', 'PDF'];

        foreach ($types as $type) {
            DB::table('publication_types')->insert([
                'publication_type' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}