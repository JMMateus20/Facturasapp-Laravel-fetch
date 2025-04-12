<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body class="bg-light py-5">

    <div class="container"> 
        <h1 class="text-center mb-4">Listado de Facturas</h1>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFactura">
            Crear factura
        </button>
    
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Numero</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
            </tr>
            </thead>
            <tbody>
                @if (count($facturas)>0)
                    @foreach ($facturas as $indice=>$factura)
                    <tr>
                        <th scope="row">{{ $indice+1 }}</th>
                        <td>{{ $factura->numero }}</td>
                        <td>{{ $factura->fecha }}</td>
                        <td>{{ $factura->estado }}</td>
                    </tr>
                    @endforeach
                @endif
            
            
            </tbody>
        </table>

        <!-- Button trigger modal -->
        
        
        <!-- Modal -->
        <div class="modal fade" id="modalFactura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 1000px;">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear factura</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formFactura">
                    <div class="modal-body">
                        
                            
                            
                                @csrf
                                <div class="mb-3">
                                    <label for="numero" class="form-label">Numero</label>
                                    <input type="text" class="form-control" id="numero" name="numero">
                                </div>

                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha">
                                </div>

                                <div class="mb-3">
                                    <label for="cliente_nombre" class="form-label">Cliente</label>
                                    <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre">
                                </div>

                                <div class="mb-3">
                                    <label for="vendedor" class="form-label">Vendedor</label>
                                    <input type="text" class="form-control" id="vendedor" name="vendedor">
                                </div>

                                <div class="mb-3">
                                    
                                    <label for="estado" class="form-label">Estado</label>
                                    <select id="estado" name="estado">
                                        <option value="1">ACTIVA</option>
                                        <option value="0">INACTIVA</option>
                                    </select>
                                </div>
                                
                    
                                <!-- Detalles de la factura -->
                                <h4>Detalles de la Factura</h4>
                                <div id="items">
                                    <div class="item mb-3">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="producto[]" class="form-label">Producto</label>
                                                <input type="text" class="form-control" name="producto[]" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="cantidad[]" class="form-label">Cantidad</label>
                                                <input type="number" class="form-control cantidad" name="cantidad[]" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="precio[]" class="form-label">Precio</label>
                                                <input type="number" step="0.01" class="form-control precio" name="precio[]" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Subtotal</label>
                                                <input type="text" class="form-control subtotal" name="subtotal[]" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="remove-item" class="form-label">Eliminar</label>
                                                <button type="button" class="btn btn-danger remove-item" style="margin-top: 30px;">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="button" class="btn btn-primary" id="add-item">Agregar otro producto</button>
                    
                                
                            
                        
                    
                    </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnGuardarFactura">Guardar factura</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function calcularSubtotalDeFila(item) {
            const cantidad = item.querySelector('.cantidad');
            const precio = item.querySelector('.precio');
            const subtotal = item.querySelector('.subtotal');

            const c = parseFloat(cantidad.value) || 0;
            const p = parseFloat(precio.value) || 0;

            subtotal.value = (c * p).toFixed(2);
        }

        document.getElementById('items').addEventListener('input', function (e) {
            if (e.target.classList.contains('cantidad') || e.target.classList.contains('precio')) {
                const item = e.target.closest('.item');
                calcularSubtotalDeFila(item);
            }
        });

        function inicializarSubtotales() {
            document.querySelectorAll('.item').forEach(item => calcularSubtotalDeFila(item));
        }

        document.getElementById('add-item').addEventListener('click', function () {
            const original = document.querySelector('.item');
            const clone = original.cloneNode(true);

            clone.querySelectorAll('input').forEach(input => input.value = '');
            document.getElementById('items').appendChild(clone);
        });

        document.getElementById('items').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-item')) {
                const items = document.querySelectorAll('.item');
                if (items.length > 1) {
                    e.target.closest('.item').remove();
                    actualizarSubtotales();
                }
            }
        });

        inicializarSubtotales();

        document.getElementById("btnGuardarFactura").addEventListener("click", guardarFactura);
        async function guardarFactura(){
            const form = document.getElementById('formFactura');

            const numero = form.querySelector('[name="numero"]').value;
            const fecha = form.querySelector('[name="fecha"]').value;
            const cliente_nombre = form.querySelector('[name="cliente_nombre"]').value;
            const vendedor = form.querySelector('[name="vendedor"]').value;
            const estado = form.querySelector('[name="estado"]').value;

            const items = [];
            document.querySelectorAll('#items .item').forEach(item => {
                const producto = item.querySelector('[name="producto[]"]').value;
                const cantidad = parseFloat(item.querySelector('[name="cantidad[]"]').value) || 0;
                const precio = parseFloat(item.querySelector('[name="precio[]"]').value) || 0;
                const subtotal = parseFloat(item.querySelector('[name="subtotal[]"]').value) || 0;

                if (producto) {
                    items.push({
                        producto: producto,
                        cantidad: cantidad,
                        precio: precio,
                        subtotal: subtotal
                    });
                }
            });

            // Crear objeto de datos a enviar
            const datos = {
                numero,
                fecha,
                cliente_nombre,
                vendedor,
                estado,
                detalles: items
            };

            // Enviar con fetch como JSON
            try {
                const response = await fetch("{{ url('/facturas/create') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(datos)
                });

                const reponseBody = await response.json();
                if (!response.ok) {
                    if (response.status === 400) {
                        
                        console.error("Errores de validación:", reponseBody.errors);
                        const mensajes = Object.values(reponseBody.errors)
                            .flat()
                            .map(msg => `• ${msg}`)
                            .join('\n');

                        Swal.fire({
                            icon: 'error',
                            title: 'Errores de validación',
                            text: 'Revisa los siguientes errores:',
                            html: `<pre style="text-align:left;">${mensajes}</pre>`,
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }else{
                    Swal.fire('Exito', reponseBody.success, 'success');
                }

            } catch (error) {
                console.error("Error al guardar la factura:", error);
                alert("Error de conexión o en la petición.");
            }
        }
    </script>

</body>
</html>