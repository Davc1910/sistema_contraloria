<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['articulo_especifico_id', 'articulo_especifico_type', 'tipo_biene'];

    public function articuloEspecifico()
    {
        return $this->morphTo();
    }

}
