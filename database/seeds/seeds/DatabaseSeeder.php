<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
        /*
        App\User::create([
            'name'=>'Ruggeri Barbosa',
            'email'=>'ruggeri@hotmail.com',
            'password'=>bcrypt('1234')
        ]);
        */
    }
}
