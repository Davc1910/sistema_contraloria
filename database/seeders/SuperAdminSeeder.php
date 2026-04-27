<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        * Este seeder ahora es "Idempotente".
        * Usará 'firstOrCreate' para buscar primero al usuario y al rol.
        * Si no los encuentra, los creará.
        * Si ya existen, simplemente los obtendrá sin lanzar un error.
        */

        // 1. Crea o encuentra al usuario 'Alvaro Valero'
        $usuario = User::firstOrCreate(
            ['email' => 'alvaleromendoza@gmail.com'], // Columna única para buscar
            [
                'name' => 'Alvaro Valero',
                'username' => 'alv10',
                'password' => '123456',
            ]
        );

        // 2. Crea o encuentra el rol 'Administrador'
        $rol = Role::firstOrCreate(
            ['name' => 'Administrador', 'guard_name' => 'web'] // Columna única para buscar
        );

        // 3. Obtiene todos los permisos existentes (asumiendo que otro seeder los creó)
        $permisos = Permission::pluck('id', 'id')->all();

        // 4. Sincroniza los permisos con el rol (esto es idempotente, no da error si ya los tiene)
        $rol->syncPermissions($permisos);

        // 5. Asigna el rol al usuario (esto también es idempotente)
        $usuario->assignRole($rol); // Puedes pasar el objeto $rol directamente
    }
}
