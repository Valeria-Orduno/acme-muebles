@extends('layouts.app')

@section('content')
    <h1>Panel de Administración</h1>
    <a href="{{ route('productos.index') }}">Gestionar Productos</a>
    <a href="{{ route('clientes.index') }}">Gestionar Clientes</a>
@endsection
