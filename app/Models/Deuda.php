<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    protected $fillable = [
        'persona_id', 'monto', 'descripcion', 'fecha'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
