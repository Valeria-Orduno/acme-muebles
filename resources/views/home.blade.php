@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if(auth()->user()->isAdmin())
                        <h4>Bienvenido, Administrador</h4>
                        <p>Administra los productos y clientes desde aquí:</p>
                        <a href="{{ route('productos.index') }}" class="btn btn-primary">Administrar Productos</a>
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Administrar Clientes</a>
                    
                    @elseif(auth()->user()->isCliente())
                        <h4>Bienvenido, Cliente</h4>
                        <p>Explora nuestros productos y realiza tus compras.</p>

                        <div class="row">
                            @foreach($productos as $producto)
                                <div class="col-md-4">
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                                            <p class="card-text">{{ $producto->descripcion }}</p>
                                            <p class="card-text"><strong>Precio:</strong> ${{ $producto->precio }}</p>
                                            
                                            @if(auth()->user()->cliente && auth()->user()->cliente->tipo == 3)
                                                <p class="text-success"><strong>Descuento:</strong> -10%</p>
                                                <p class="card-text"><strong>Precio final:</strong> ${{ $producto->precio * 0.9 }}</p>
                                            @endif

                                            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-success">Comprar</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
