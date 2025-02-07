<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria', // Puede ser 'premium' o 'básico'
        'stock',
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_producto')
                    ->withPivot('cantidad', 'precio_total')
                    ->withTimestamps();
    }

    public function esPremium()
    {
        return $this->categoria === 'premium';
    }
}
