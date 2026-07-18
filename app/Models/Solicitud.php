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
    protected $fillable = [ 'id_persona','id_mobiliario','id_periferico', 'fecha',];

    // // Relaciones (si es necesario)
    public function persona()
    {
        return $this->belongsTo(Personas::class, 'id_persona');
    }

    public function mobiliario()
    {
        return $this->belongsTo(Mobiliarios::class, 'id_mobiliario');
    }

    public function periferico()
    {
        return $this->belongsTo(Perifericos::class, 'id_periferico');
    }

     public function incorporar()
    {
        return $this->hasMany(Incorporar::class, 'id_asignacion');
    }

    // public function control_seguimiento()
    // {
    //     return $this->belongsToMany(ControlSeguimientos::class, 'id_seguimiento', 'id', 'id_asignacion');
    // }

}
