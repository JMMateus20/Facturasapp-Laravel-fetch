<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FacturaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'numero'=>'required|string|max:255|unique:facturas,numero',
            'fecha'=>'required|date',
            'cliente_nombre'=>'required|string|max:255',
            'vendedor'=>'required|string|max:255',
            'detalles' => 'required|array',
            'detalles.*.producto' => 'required|string|max:255',
            'detalles.*.cantidad' => 'required|numeric|min:0.01',
            'detalles.*.precio' => 'required|numeric|min:0',
            'detalles.*.subtotal' => 'required|numeric|min:0'
        ];
    }

    public function messages(): array{
        return [
            'numero.required' => 'El numero de la factura es un campo obligatorio',
            'numero.unique'=>'El numero de la factura ingresado ya existe',
            'cliente_nombre.required'=>'El nombre del cliente es requerido',
            'fecha.date'=>'La fecha debe ser una fecha válida',
            'vendedor.required'=>'El campo vendedor es requerido'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Errores de validación',
            'errors' => $validator->errors()
        ], 400));
    }
}
