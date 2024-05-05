@extends('layouts.app')

@section('content')
<?php 
$date =  new DateTime($pedido->pedido_fec_pre);
$date2 = new DateTime();
if($pedido->pedido_fec_ent){
    $date2 =  new DateTime($pedido->pedido_fec_ent);
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
            <div class="card">
                <div class="card-header">{{ __('Detalle Prestamo') }}</div>
                <div class="card-body">
                    
                    <!-- informacion pretamo -->
                    {{ __('Solicito').": ".$user->name." ".$user->surname }}
                    <br>
                    {{ __('Fecha solicitud').": ".$date->format('d-m-Y') }}
                    <br>
                    {{ __('Estado').": " }}
                    @if($pedido->pedido_estado == '1')
                    {{ __('Activo') }}
                    @else
                    {{ __('Entregado') }}
                    <br>
                    {{ __('Fecha entrega').": ".$date2->format('d-m-Y') }}
                    @endif

                    <!-- FIN informacion pretamo -->

                    <!-- materiales prestamo -->

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Material</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido_materials as $pedido_material)
                                <tr>
                                    <td>
                                        {{ $pedido_material->material->material_id }}
                                    </td>
                                    <td>
                                        {{ $pedido_material->material->material_name }}
                                    </td>
                                    <td>
                                        @switch($pedido_material->material->material_estado)
                                            @case('1')
                                                {{ __('Nuevo') }}
                                                @break
                                            @case('2')
                                                {{ __('Bueno') }}
                                                @break
                                            @case('3')
                                                {{ __('Regular') }}
                                                @break
                                        @endswitch
                                        
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <!-- FIN materiales prestamo -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
