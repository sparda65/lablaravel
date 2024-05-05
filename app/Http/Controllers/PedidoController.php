<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Pedido;
use App\Models\PedidoMaterial;
use App\Models\User;

class PedidoController extends Controller
{
    //restringir acceso a usuarios sin auntenticar
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function regisPedido(){//mostrar vista
        /*  Verificar rol en el sistema   */
        $user = \Auth::user();
        // $roles = $user->getRoleNames();
        // if($roles[0] != 'admin'){
        //     return redirect()->route('home')->with([
        //         'messageError' => 'No tienes permisos para entrar a este modulo!!!'
        //     ]);
        // }
        $materiales = Material::where('material_disponibilidad', '1')->get();
        
        return view('pedido.prestamo', [
            'materiales' => $materiales
        ]);
    }
    public function guardarPedido(Request $req){
        if(!$req->check_material){
            $materiales = Material::where('material_disponibilidad', '1')->get();
            return redirect()->route('pedidoNuevo',['materiales' => $materiales])->with(
                [
                    'messageError' => 'Debes de seleccionar al menos un material para realizar tu pedido!!'
                ]
            );
        }
        /* disponibilidadMaterial   ->  1->disponible
                                        0->en uso


            EstadoPedido            ->  1->Activo
                                        0->Terminado
        */

        //checar que existan los materiales y no esten en uso

        foreach ($req->check_material as $material_id) {
            $material = Material::find($material_id);
            if($material->material_id && $material->material_disponibilidad == '0'){
                $materiales = Material::where('material_disponibilidad', '1')->get();
                return redirect()->route('pedidoNuevo',['materiales' => $materiales])->with(
                    [
                        'messageError' => 'Error, los materiales no estan disponibles!!'
                    ]
                );
            }
        }

        $user = \Auth::user();
        
        //guardar pedido
        $pedido = new Pedido();
        $pedido->pedido_user_id = $user->id;
        $pedido->pedido_estado = '1';
        $pedido->pedido_fec_pre = date('Y-m-d H:i:s');
        $pedido->save();
        //obtener id del ultimo pedido
        $pedido = Pedido::orderBy('pedido_id', 'desc')->first();

        //actualizar disponibilidad, guardar relacion pedido_material
        foreach ($req->check_material as $material_id) {
            
            $pedidoMaterial = new PedidoMaterial();
            //actualizar disponibilidad
            $material = Material::find($material_id);
            $material->material_disponibilidad = '0';
            $material->update();
            //guardar nuevo pedido material
            $pedidoMaterial->pedido_id = $pedido->pedido_id;
            $pedidoMaterial->pedido_user_id = $user->id;
            $pedidoMaterial->pedido_material_id = $material->material_id;
            
            $pedidoMaterial->save();
        }
        /*
        *
        *FALTA ENVIAR CORREO
        *
        */ 
        return redirect()->route('generarPDF', 
            ['id'=>$pedido->pedido_id."-".$user->id]
        );
    }

    public function detPedido($id){//detalle pedido
        /*
        id es un conjunto de ids
        pedido_id-pedido_user_id
        */

        $ids = explode("-", $id);//explode() divide la cadena por el guion
        $pedido_id = $ids[0];
        $pedido_user_id = $ids[1];
        $user_pedido = User::find($pedido_user_id);
        $pedido_data = Pedido::find($pedido_id);
        $pedido_materials = PedidoMaterial::where('pedido_id', $pedido_id)
                                            ->where('pedido_user_id', $pedido_user_id)
                                            ->get();

        
        return view('pedido.detallePedido',
            [
                'pedido_materials' => $pedido_materials,
                'user' => $user_pedido,
                'pedido' => $pedido_data
            ]
        );
    }

    public function entPedido($id){//entrega pedido confirmacion
        /*
        id es un conjunto de ids
        pedido_id-pedido_user_id
        */
        /*  Verificar rol en el sistema   */
        $user = \Auth::user();
        $roles = $user->getRoleNames();
        if($roles[0] != 'admin'){
            return redirect()->route('home')->with([
                'messageError' => 'No tienes permisos para entrar a este modulo!!!'
            ]);
        }

        $ids = explode("-", $id);//explode() divide la cadena por el guion
        $pedido_id = $ids[0];
        $pedido_user_id = $ids[1];
        $user_pedido = User::find($pedido_user_id);
        $pedido_data = Pedido::find($pedido_id);
        $pedido_materials = PedidoMaterial::where('pedido_id', $pedido_id)
                                            ->where('pedido_user_id', $pedido_user_id)
                                            ->get();

        
        return view('pedido.entregaPedido',
            [
                'pedido_materials' => $pedido_materials,
                'user' => $user_pedido,
                'pedido' => $pedido_data,
                'pedido_id' => $pedido_id
            ]
        );
    }

    public function confirmaEntPedido(Request $req){
        /*  Verificar rol en el sistema   */
        $user = \Auth::user();
        $roles = $user->getRoleNames();
        if($roles[0] != 'admin'){
            return redirect()->route('home')->with([
                'messageError' => 'No tienes permisos para entrar a este modulo!!!'
            ]);
        }

        $ids = explode("-", $req->entrega);//explode() divide la cadena por el guion
        $pedido_id = $ids[0];
        $pedido_user_id = $ids[1];
        $pedido_data = Pedido::find($pedido_id);//llenar datos del pedido

        $pedido_materials = PedidoMaterial::where('pedido_id', $pedido_id)
                                            ->where('pedido_user_id', $pedido_user_id)
                                            ->get();

        $pedido_data->pedido_fec_ent = date('Y-m-d H:i:s');//set fecha entrega
        $pedido_data->pedido_estado = "0";//update estado
        $pedido_data->update();

        
        foreach ($pedido_materials as $pm) {
            $material = Material::find($pm->material->material_id);
            $material->material_disponibilidad = "1";
            $material->update();
        }
        return redirect()->route('home')->with(
            [
                'message' => 'Material entregado!!'
            ]
        );
    }

}
