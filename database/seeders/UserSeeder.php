<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
    $user = User::firstOrCreate(
        ['email' => 'user@example.com'],
        ['name'=>'user', 'password' => Hash::make('user')]

    );
    $user->assignRole('user');
    $admin = User::firstOrCreate(
        ['email' => 'admin@example.com'],
        ['name'=>'admin', 'password' => Hash::make('admin')]

    );
    $admin->assignRole('admin');
  }
}
