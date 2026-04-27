<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPerifericos extends Model
{
    use HasFactory;
    protected $table = 'tipo_perifericos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [ 'tipo'];

    public function perifericos()
    {
        return $this->hasMany(Perifericos::class, 'id_tipo');
    }

}
