<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'id_persona','id_articulo', 'fecha', 'descripcion'];

    // // Relaciones (si es necesario)
    public function persona()
    {
        return $this->belongsTo(Personas::class, 'id_persona');
    }

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'articulo_solicituds', 'id_solicitud', 'id_articulo');
    }

    public function articulosSolicitud()
    {
        return $this->hasMany(ArticuloSolicitud::class, 'id_solicitud', 'id');
    }

}
