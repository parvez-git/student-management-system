<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'name'     => 'Parvez Alam',
          'username' => 'parvez',
          'email'    => 'p4alam@gmail.com',
          'password' => bcrypt('123456'),
          'remember_token' => str_random(10),
          'active'   => '1',
          'role_id'  => '1',
        ]);
    }
}
