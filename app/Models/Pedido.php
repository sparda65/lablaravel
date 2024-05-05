<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'pedido_id';//especificar nombre de la llave primaria

    public function user(){
        // modelo al que se hace referencia
        // llave foranea de la tabla de la clase actual
        // llave primaria al que se hace referencia
        return $this->belongsTo(User::class, 'pedido_user_id', 'user_id');
    }


    public function pedidoMaterial()
    {
        return $this->hasMany(PedidoMaterial::class);
    }
}
