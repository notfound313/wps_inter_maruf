<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserHierarchy;
use App\Models\Role;

class UserHierarchySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directors = User::whereHas('role', function ($query) {
            $query->where('name', 'Direktur');
        })->get();

        $managers = User::whereHas('role', function ($query) {
            $query->where('name', 'Manager');
        })->get();

        $staffs = User::whereHas('role', function ($query) {
            $query->where('name', 'Staff');
        })->get();

        foreach ($directors as $director) {
            foreach($managers as $manager){                
                if (!UserHierarchy::where('subordinate_id', $manager->id)
                                  ->where('supervisor_id', $director->id)
                                  ->exists()) {
                    UserHierarchy::create([
                        'subordinate_id' => $manager->id,
                        'supervisor_id' => $director->id,
                    ]);
                }

            }
           
        }
        foreach ($managers as $manager) {
            foreach($staffs as $staff){
                if($manager->name === 'Manager Keuangan' && $staff->name ==='Staff Keuangan' ){
                    if (!UserHierarchy::where('subordinate_id', $staff->id)
                                  ->where('supervisor_id', $manager->id)
                                  ->exists()) {
                    UserHierarchy::create([
                        'subordinate_id' => $staff->id,
                        'supervisor_id' => $manager->id,
                    ]);
                }

                }else if($manager->name === 'Manager Operasional' && $staff->name ==='Staff Operasional') {
                   if (!UserHierarchy::where('subordinate_id', $staff->id)
                                  ->where('supervisor_id', $manager->id)
                                  ->exists()) {
                    UserHierarchy::create([
                        'subordinate_id' => $staff->id,
                        'supervisor_id' => $manager->id,
                    ]);
                }
                }
                

            }

             
        }


    }
}
