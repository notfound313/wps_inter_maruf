<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      $direkturRoleId = Role::where('name', 'Direktur')->first()->id;
      $managerRoleId = Role::where('name', 'Manager')->first()->id;
      $staffRoleId = Role::where('name', 'Staff')->first()->id;

      $users = [
        [
          'name' => 'Direktur User',
          'email' => 'admin@example.com',
          'password' => Hash::make('password'),
          'role_id' => $direkturRoleId,
        ],
        [
          'name' => 'Manager User',
          'email' => 'manager@example.com',
          'password' => Hash::make('password'),
          'role_id' => $managerRoleId,
        ],
        [
          'name' => 'Staff User',
          'email' => 'Staff@example.com',
          'password' => Hash::make('password'),
          'role_id' => $staffRoleId,
        ]
        ];

      

      foreach ($users as $user) {        
        if (!User::where('email', $user['email'])->exists()) {
            User::create($user);
        }
    }
    }
}
