<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = ['persona_id', 'fecha', 'tipo', 'total'];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'factura_producto')
            ->withPivot('cantidad'//, 'precio_unitario'
        );
    }
}
