<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EnumerateTypeTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $path = database_path('seeders/sql/enumerates_type.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('EnumerateType table seeded!');
    }
}
