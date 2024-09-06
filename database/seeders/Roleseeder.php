<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $roles =[
            ['name' => 'Direktur'],
            ['name' => 'Manager'],
            ['name' => 'Staff'],
        ];
        foreach ($roles as $role) {
            
            if (!DB::table('roles')->where('name', $role['name'])->exists()) {
                DB::table('roles')->insert($role);
            }
        }
    }
}
