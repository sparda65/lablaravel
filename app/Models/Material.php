<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';//especificar nombre de la tabla
    protected $primaryKey = 'material_id';//especificar nombre de la llave primaria

    public function pedidoMaterial(){
        // modelo al que se hace referencia
        // llave foranea de la tabla de la clase actual
        // llave primaria al que se hace referencia
        return $this->hasMany(Pedido::class, 'pedido_material_id', 'material_id');
    }
}
