<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoMaterial extends Model
{
    protected $table = 'pedido_material';

    public function material(){
        // modelo al que se hace referencia
        // llave foranea de la tabla de la clase actual
        // llave primaria al que se hace referencia
        return $this->belongsTo(Material::class, 'pedido_material_id', 'material_id');
    }

    public function pedido(){
        // modelo al que se hace referencia
        // llave foranea de la tabla de la clase actual
        // llave primaria al que se hace referencia
        return $this->belongsTo(Pedido::class, 'pedido_id', 'pedido_id');
    }
}
