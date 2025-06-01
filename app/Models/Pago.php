<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'persona_id', 'deuda_id', 'fecha', 'monto', 'metodo_pago', 'descripcion'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function deuda()
    {
        return $this->belongsTo(Deuda::class);
    }
}
