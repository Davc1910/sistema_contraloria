<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ReneViveirosSeeder extends Seeder
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
            ['email' => 'reneviveiros@gmail.com'], // Columna única para buscar
            [
                'name' => 'Rene Viveiros',
                'username' => 'reneviveiros',
                'password' =>'123456', 
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
        $usuario->assignRole($rol); // Puedes pasar el objeto $rol directamenteÑ

        // // 2. Busca el rol 'Administrador' (que ya fue creado por AlvaroValeroSeeder)
        // $rol = Role::firstOrCreate(
        //     ['name' => 'Administrador', 'guard_name' => 'web']
        // );

        // // 3. Asigna el rol al usuario
        // $usuario->assignRole($rol);
    }
}