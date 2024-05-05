<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Material;
use App\Models\Pedido;
use App\Models\PedidoMaterial;
use App\Models\User;

class PDFController extends Controller
{
    public function PDF()
    {
        $pdf = \PDF::loadview('pdf.prueba');
        return $pdf->stream('prueba.pdf');

    }

    public function generarPDF($id){
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
        $pdf = \PDF::loadview('pdf.templatePDF', [
                'pedido_materials' => $pedido_materials,
                'user' => $user_pedido,
                'pedido' => $pedido_data
            ]);
        $pdfName = "prestamo".$id.".pdf";
        Storage::disk('PDF')->put($pdfName, $pdf->download($pdfName));//guardaPDF en el servidor
        
        return redirect()->route('enviarMail', 
            ['id'=>$pedido_id."-".$pedido_user_id]
        );
    }

}
