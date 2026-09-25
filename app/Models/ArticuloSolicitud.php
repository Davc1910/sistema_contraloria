<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloSolicitud extends Model
{
    use HasFactory;
    protected $table = 'articulo_solicituds';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_solicitud','id_articulo'];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'id_articulo', 'id');
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'id_solicitud', 'id');
    }
}
