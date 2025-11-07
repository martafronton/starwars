<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class Rol extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['nombre' => 'admin'],
            ['nombre' => 'gestor'],
            ['nombre' => 'usuario'],
        ]);

        $user = User::find(1);
        $role = Role::where('nombre', 'admin')->first();

        if ($user && $role) {
            $user->roles()->attach($role->id);
        }
    }
}
