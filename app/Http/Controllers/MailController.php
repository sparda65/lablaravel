<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Mail\MensajeRecibido;
use App\Models\User;
use App\Models\Pedido;

class MailController extends Controller
{
    public function enviarMail($id){
        $ids = explode("-", $id);//explode() divide la cadena por el guion
        $pedido_id = $ids[0];
        $pedido_user_id = $ids[1];
        $user = User::find($pedido_user_id);
        $pedido_data = Pedido::find($pedido_id);

        $filename = "prestamo".$id.".pdf";
        $message = [
            'name' => $user->name,
            'email' => $user->email,
            'subject' => 'Orden de Pedido: '.$id,
            'content' => 'Buen dia, aqui esta el archivo PDF con la informacion de lo que has solicitado a traves de la plataforma, por favor presentalo al laboratorista',
            'filename' => $filename
        ];
        
        Mail::to($user->email)->send(new MensajeRecibido($message));
        return redirect()->route('home')->with(
            [
                'message' => 'Pedido Realizado!!, se enviado un archivo PDF a tu correo, por favor, revisa la bandeja de entrada. Si no lo encuentra, por favor revise en la bandeja de SPAM. Debes presentarla para que te sean entregados los materiales'
            ]
        );

    }
}
