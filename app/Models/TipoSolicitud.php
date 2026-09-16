<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSolicitud extends Model
{
    use HasFactory;
    protected $table = 'tipo_solicitudes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'id_solicitud', 'estatus', 'fecha', 'descripcion' ];

    // // Relaciones (si es necesario)
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'id_solicitud');
    }
}
