<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacturaRequest;
use App\Models\DetalleFactura;
use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    public function getAll(){
        return view('facturas', ['facturas'=>Factura::all()]);
    }

    public function save(FacturaRequest $req){
        //dd($req->all());
        try{

        
            DB::beginTransaction();
            $facturaNew=new Factura();
            $facturaNew->numero=$req->numero;
            $facturaNew->fecha=$req->fecha;
            $facturaNew->cliente_nombre=$req->cliente_nombre;
            $facturaNew->vendedor=$req->vendedor;
            $facturaNew->estado=(int) $req->estado;

            $granTotal=0;
            foreach($req->detalles as $detalle){
                $granTotal+=$detalle['subtotal'];
            }

            $facturaNew->valor_total=$granTotal;

            $facturaNew->save();

            foreach($req->detalles as $detalle){
                $detalleNew=new DetalleFactura();
                
                $detalleNew->factura_id=$facturaNew->id;
                $detalleNew->cantidad=$detalle['cantidad'];
                $detalleNew->precio_unitario=$detalle['precio'];
                $detalleNew->subtotal=$detalle['subtotal'];

                $detalleNew->save();

            }
            DB::commit();
            return response()->json(['success'=>'Factura Creada con éxito'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
