<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'id_evaluacion','id_vocero','id_comunidad', 'id_ayuda', 'descri_alcance', 'moneda_presu', 'presupuesto',
    'impacto_ambiental', 'impacto_social', 'imagenes','latitud','longtud','direccion', 'fecha_inicio', 'duracion_estimada'];

    // // Relaciones (si es necesario)
    // public function evaluacion()
    // {
    //     return $this->belongsTo(Evaluaciones::class, 'id_evaluacion');
    // }

    // public function vocero()
    // {
    //     return $this->belongsTo(Voceros::class, 'id_vocero');
    // }

    // public function comunidad()
    // {
    //     return $this->belongsTo(Comunidades::class, 'id_comunidad');
    // }

    // public function ayuda()
    // {
    //     return $this->belongsTo(Ayudas::class, 'id_ayuda');
    // }

    // public function control_seguimiento()
    // {
    //     return $this->belongsToMany(ControlSeguimientos::class, 'id_seguimiento', 'id', 'id_asignacion');
    // }

}
