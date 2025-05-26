<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'cantidad', 'precio', 'tipo'];

    public function facturas()
    {
        return $this->belongsToMany(Factura::class, 'factura_producto')
            ->withPivot('cantidad'//, 'precio_unitario'
        );
    }
}
