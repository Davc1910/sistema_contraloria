<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PatriciaSalomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $usuario = User::create([
            'name' => 'Patricia Salom',
            'email' => 'patriciasalom@gmail.com',
            'username' => 'patriciasalom',
            'password' => ('123456'),
        ]
        );

        // 2. Busca el rol 'Administrador' (que ya fue creado por AlvaroValeroSeeder)
        $rol = Role::firstOrCreate(
            ['name' => 'Administrador', 'guard_name' => 'web']
        );

        // 3. Asigna el rol al usuario
        $usuario->assignRole($rol);
    }
}

