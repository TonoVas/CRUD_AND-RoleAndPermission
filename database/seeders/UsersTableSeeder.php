<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usuario es el rol editor
        $editor = User::create([
            'name'=>'editor',
            'email'=>'4@gmail.com',
            'password'=>bcrypt('123456789')
        ]);
        $editor->assignRole('editor');

        //usuario es el rol usuario

        $user = User::create([
            'name'=>'usuario',
            'email'=>'1@gmail.com',
            'password'=>bcrypt('123456789')
        ]);
        $user->assignRole('usuario');

        //usuario es el rol moderador

        $moderador = User::create([
            'name'=>'Moderador',
            'email'=>'2@gmail.com',
            'password'=>bcrypt('123456789')
        ]);
        $moderador->assignRole('Moderador');

        //usuario es el rol super-admin
        $admin = User::create([
            'name'=>'admin',
            'email'=>'3@gmail.com',
            'password'=>bcrypt('123456789')
        ]);
        $admin->assignRole('super-admin');
    }
}
