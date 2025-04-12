<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table="detalle_factura";

    public $timestamps=true;
    protected $fillable = [
        'factura_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
        'estado',
        'valor_total'
    ];


    public function factura(){
        return $this->belongsTo(Factura::class, 'factura_id', 'id');
    }
}
