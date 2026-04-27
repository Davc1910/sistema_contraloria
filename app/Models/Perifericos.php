<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perifericos extends Model
{
    use HasFactory;

    protected $table = 'perifericos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'id_tipo', 'id_marca', 'id_modelo', 'serial' ];

    public function tipo_periferico()
    {
        return $this->belongsTo(TipoPerifericos::class, 'id_tipo');
    }

    public function marca()
    {
        return $this->belongsTo(Marcas::class, 'id_marca');
    }

    public function modelo()
    {
        return $this->belongsTo(Modelos::class, 'id_modelo');
    }

}
