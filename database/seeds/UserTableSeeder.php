<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'nome'=>'RUGGERI BARBOSA',
            'email'=>'ruggeri.nascimento@hotmail.com.br',
            'password'=>bcrypt('10904315'),
            'idempregadora'=>0
        ]);
    }
}
