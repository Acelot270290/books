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
        $user = new User();
        $user->name = 'Acelot';
        $user->email = 'contato@alandiniz.com.br';
        $user->password = Hash::make('Acelot.270290');
        $user->save();
    }
}
