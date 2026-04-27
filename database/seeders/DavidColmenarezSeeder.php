<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DavidColmenarezSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Crea o encuentra al usuario
        $usuario = User::firstOrCreate(
            ['email' => 'augustodcolmenarez19@gmail.com'], // Columna única para buscar
            [
                'name' => 'David Colmenarez',
                'username' => 'davidplay',
                'password' =>'123456',
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
