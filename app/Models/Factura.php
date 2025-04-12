<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{


    public $timestamps=true;
    protected $fillable = [
        'numero',
        'fecha',
        'cliente_nombre',
        'vendedor',
        'estado',
        'valor_total'
    ];


    public function detalle(){
        return $this->hasMany(DetalleFactura::class, 'factura_id', 'id');
    }
}
