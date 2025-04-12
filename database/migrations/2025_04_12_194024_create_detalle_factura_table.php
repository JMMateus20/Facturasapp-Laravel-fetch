<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factura_id');
            $table->integer('cantidad');
            $table->float('precio_unitario',2)->default(0);
            $table->float('subtotal', 2)->default(0);
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_factura');
    }
};
