<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\User;

class MaterialController extends Controller
{
    //restringir acceso a usuarios sin auntenticar
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function regisMaterial(){//mostrar vista
        /*  Verificar rol en el sistema   */
        $user = \Auth::user();
        $roles = $user->getRoleNames();
        if($roles[0] != 'admin'){
            return redirect()->route('home')->with([
                'messageError' => 'No tienes permisos para entrar a este modulo!!!'
            ]);
        }
        return view('material.registrarMaterial');
    }
    public function guardarMaterial(Request $req){//guardar
        /*  Verificar rol en el sistema   */
        $user = \Auth::user();
        $roles = $user->getRoleNames();
        if($roles[0] != 'admin'){
            return redirect()->route('home')->with([
                'messageError' => 'No tienes permisos para entrar a este modulo!!!'
            ]);
        }
        /*
        estadoMaterial ->   1->Nuevo
                            2->Bueno
                            3->Regular
        disponibilidadMaterial ->   1->disponible
                                    0->en uso
        */
        $material = new Material();
        $estado = "";

        $validate = $this->validate($req,[
                                'matname' => 'string|required',
                                'description'  => 'string|required',
                                'estado'  => 'integer|digits_between:1,3|required']);

        $material->material_name = $req->input('matname');
        $material->material_disponibilidad = '1';
        $material->material_descripcion = $req->input('description');
        $material->material_estado = $req->input('estado');

        $material->save();
        return redirect()->route('materialNuevo')->with(
            [
                'message' => 'Material Registrado correctamente!!!'
            ]
        );
    }
    public function EditMaterial($id){
        /*  Verificar rol en el sistema   */
        $user = \Auth::user();
        $roles = $user->getRoleNames();
        if($roles[0] != 'admin'){
            return redirect()->route('home')->with([
                'messageError' => 'No tienes permisos para entrar a este modulo!!!'
            ]);
        }

        $material = Material::find($id);
        return view('material.editMaterial', [
            'material' => $material,
        ]);
    }

    public function actMaterial(Request $req){
        /*  Verificar rol en el sistema   */
        $user = \Auth::user();
        $roles = $user->getRoleNames();
        if($roles[0] != 'admin'){
            return redirect()->route('home')->with([
                'messageError' => 'No tienes permisos para entrar a este modulo!!!'
            ]);
        }

        /*
        estadoMaterial ->   1->Nuevo
                            2->Bueno
                            3->Regular
        disponibilidadMaterial ->   1->disponible
                                    0->en uso
        */
        $material = new Material();
        $material = Material::where('material_id', $req->input('material_id'))->first();

        $validate = $this->validate($req,[
                                'matname' => 'string|required',
                                'description'  => 'string|required',
                                'estado'  => 'integer|digits_between:1,3|required']);

        $material->material_name = $req->input('matname');
        $material->material_descripcion = $req->input('description');
        $material->material_estado = $req->input('estado');

        $material->update();
        
        //redireccionar usuario 
        return redirect()->route('EditarMaterial', [
            'id' => $material->material_id,
        ])->with(['message' => 'Material Actualizado correctamente!!!']);
    }

    public function listarMateriales(){
        /*  Verificar rol en el sistema   */
        $user = \Auth::user();
        $roles = $user->getRoleNames();
        if($roles[0] != 'admin'){
            return redirect()->route('home')->with([
                'messageError' => 'No tienes permisos para entrar a este modulo!!!'
            ]);
        }

        $materiales = Material::All();
        
        return view('material.listMaterial', [
            'materiales' => $materiales
        ]);
    }
}
