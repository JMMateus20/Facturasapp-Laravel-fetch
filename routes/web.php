<?php

use App\Http\Controllers\FacturaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FacturaController::class, 'getAll']);
Route::post('/facturas/create', [FacturaController::class,'save']);
