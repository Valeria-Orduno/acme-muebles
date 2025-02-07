<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;

class ClienteController extends Controller
{
    /**
     * Muestra una lista de todos los clientes.
     */
    public function index()
    {
        $clientes = Cliente::with('user')->get(); // Trae clientes junto con su usuario
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Muestra el formulario para crear un nuevo cliente.
     */
    public function create()
    {
        $usuarios = User::whereDoesntHave('cliente')->get(); // Filtra usuarios sin cliente
        return view('clientes.create', compact('usuarios'));
    }

    /**
     * Guarda un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'contacto' => 'required|string|max:255',
            'tipo' => 'required|in:1 estrella,2 estrellas,3 estrellas',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un cliente.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualiza la información de un cliente.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'contacto' => 'required|string|max:255',
            'tipo' => 'required|in:1 ,2 ,3 ',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Elimina un cliente de la base de datos.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
