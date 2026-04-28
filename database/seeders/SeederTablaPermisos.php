<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
                                                    /* DESCOMENTAR AL EJECUTAR EL SEEDER LA PRIMERA VEZ (SI NO HAY REGISTROS EN LA BASE DE DTAOS) */

            //Operaciones sobre tabla Usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operaciones sobre tabla Oficinas
            'ver-oficina',
            'crear-oficina',
            'editar-oficina',
            'borrar-oficina',

            //Operaciones sobre tabla Personas
            'ver-persona',
            'crear-persona',
            'editar-persona',
            'borrar-persona',

            //Operaciones sobre tabla Mobilarios
            'ver-mobiliario',
            'crear-mobiliario',
            'editar-mobiliario',
            'borrar-mobiliario',

            //Operaciones sobre tabla Marcas
            'ver-marca',
            'crear-marca',
            'editar-marca',
            'borrar-marca',

            //Operaciones sobre tabla Modelos
            'ver-modelo',
            'crear-modelo',
            'editar-modelo',
            'borrar-modelo',

            //Operaciones sobre tabla TipoPerifericos
            'ver-tipo_periferico',
            'crear-tipo_periferico',
            'editar-tipo_periferico',
            'borrar-tipo_periferico',

            //Operaciones sobre tabla Perifericos
            'ver-periferico',
            'crear-periferico',
            'editar-periferico',
            'borrar-periferico',

            //Operaciones sobre tabla Asignaciones
            'ver-asignacion',
            'crear-asignacion',
            'editar-asignacion',

            //Operaciones sobre tabla Incorporar
            'ver-incorporar',
            'crear-incorporar',
            'editar-incorporar',

        ];

        foreach($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }
    }
}
