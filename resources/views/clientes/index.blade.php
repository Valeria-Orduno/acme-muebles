@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Administrar Clientes</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Contacto</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->user->name }}</td>
                    <td>{{ $cliente->contacto }}</td>
                    <td>{{ $cliente->tipo }}</td>
                    <td>
                        <!-- Falta implementar la edicion de clientes -->
                        <a href="{{ route('clientes.index') }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Falta implementar agregar clientes -->
    <a href="{{ route('clientes.index') }}" class="btn btn-primary">Agregar Cliente</a>
</div>
@endsection
