<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'nombre', 'tipo', 'telefono', 'direccion'
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function deudas()
    {
        return $this->hasMany(Deuda::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
