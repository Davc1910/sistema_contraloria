<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficinas extends Model
{
    use HasFactory;
    protected $table = 'oficinas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'nombre_oficina'];

    // Relación con el modelo Personas
    public function persona()
    {
        return $this->hasMany(Personas::class, 'id_oficina');
    }

}
