@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Productos Disponibles</h1>
    <div class="row">
        @foreach($productos as $producto)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <p class="card-text">
                            <strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}
                        </p>
                        
                        @if(auth()->user()->isAdmin())
                            <!-- Vista para admin con botones Editar (falta implementar) y Eliminar -->
                            <a href="{{ route('productos.index') }}" class="btn btn-warning">Editar</a>
                            
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este producto?')">Eliminar</button>
                            </form>
                        @else
                            <!-- Vista para cliente -->
                            @if(auth()->user()->cliente)
                                @php
                                    $cliente = auth()->user()->cliente;
                                    $descuento = $cliente->calcularDescuento();
                                @endphp
                                @if($descuento > 0)
                                    <p class="card-text text-success">
                                        <strong>Descuento:</strong> {{ $descuento * 100 }}%
                                    </p>
                                    <p class="card-text">
                                        <strong>Precio con Descuento:</strong> ${{ number_format($producto->precio - ($producto->precio * $descuento), 2) }}
                                    </p>
                                @endif
                            @endif
                            <!-- Botón de comprar para el cliente (falta implementar)-->
                            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-primary">Comprar</a>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
