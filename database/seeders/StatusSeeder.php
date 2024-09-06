<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('statuses')->count() === 0) {
            DB::table('statuses')->insert([
                ['name' => 'Pending'],
                ['name' => 'Accept'],
                ['name' => 'Reject'],
            ]);
        }
    }
}
