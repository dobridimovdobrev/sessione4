<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class HashPlainTextPasswordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Get all users
          $users = User::all();

          foreach ($users as $user) {
              // Check if the password is not already hashed
              if (!Hash::needsRehash($user->password)) {
                  continue; // Skip already hashed passwords
              }
  
              // Hash plain text password
              $user->password = Hash::make($user->password);
              $user->save();
          }
    }
}
