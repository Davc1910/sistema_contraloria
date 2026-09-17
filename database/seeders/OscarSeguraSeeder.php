<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class OscarSeguraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = User::create([
             'name' => 'Oscar Segura',
             'email' => 'oscarsegura@gmail.com',
             'username' => 'oscarsegura',
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
