<?php

use Illuminate\Database\Seeder;
use App\Program;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::insert([
          'program'     => 'CSE',
          'description' => 'Computer Science and Engineering'
        ]);
    }
}
