<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EdgarGarridoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = User::create([
             'name' => 'Edgar Garrido',
             'email' => 'edgcxrforpresident@gmail.com',
             'username' => 'edgargarrido23',
             'password' => ('29588997ed'),
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
