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

            //Operaciones sobre tabla Articulos
            'ver-articulo',
            'crear-articulo',
            'editar-articulo',
            'borrar-articulo',

            //Operaciones sobre tabla Solicitudes
            'ver-solicitud',
            'crear-solicitud',
            'editar-solicitud',

            //Operaciones sobre tabla Tipo Solicitudes
            'ver-tipo_solicitud',
            'crear-tipo_solicitud',
            'editar-tipo_solicitud',

        ];

        foreach($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }
    }
}
