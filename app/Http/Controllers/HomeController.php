<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();
        $roles = $user->getRoleNames();

        if($roles[0] == 'admin'){
            $pedidos = Pedido::orderBy('pedido_estado', 'desc')->get();
        }else{
            $pedidos = Pedido::where('pedido_user_id', $user->id)
                                ->orderBy('pedido_estado', 'desc')
                                ->get();
        }
        
        //$pedidos = Pedido::where('pedido_user_id', $user->id)->get();
                            //->where('pedido_estado', );

        return view('home', 
            [
            'pedidos' => $pedidos
            ]
        );
    }
}
