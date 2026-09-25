<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValoracionTecnicas extends Model
{
    use HasFactory;
    protected $table = 'valoracion_tecnicas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'id_tipo_solicitud', 'desincorpar', 'fecha', 'descripcion'];

    public function tipoSolicitud()
    {
        return $this->belongsTo(TipoSolicitud::class, 'id_tipo_solicitud');
    }

}
