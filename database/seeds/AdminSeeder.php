<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       return \App\User::updateOrCreate(['name'=>'admin','email'=>'admin@gmail.com','password'=> bcrypt('admin@22')]);
    }
}
