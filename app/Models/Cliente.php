<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  
        'contacto',
        'tipo', 
        'compras',
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'cliente_producto')
                    ->withPivot('cantidad', 'precio_total')
                    ->withTimestamps();
    }

    public function calcularDescuento()
    {
        if ($this->tipo == '3') {
            return 0.20; 
        }
        return 0.0; 
    }

}
