<p>
    Prestamos
    <br>
    Aqui apareceran todos los prestamos de material que hayas solicitado<br>
    Cuando termines de ocupar el material, por favor, ve con el encargado de laboratorio
    para que de por terminado el prestamo
</p>
@if(count($pedidos) == 0)
No tienes prestamos 
@else
<div class="table-responsive">
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Fecha Prestamo</th>
                <th scope="col">Fecha Entrega</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>
                        {{ $pedido->pedido_id }}
                    </td>
                    <td>
                        {{ $pedido->pedido_fec_pre }}
                    </td>
                    <td>
                        @if($pedido->pedido_fec_ent == null)
                        <div>-</div>
                        @else
                        {{$pedido->pedido_fec_ent}}
                        @endif
                    </td>
                    <td>
                        @if($pedido->pedido_estado == '1')
                        Pendiente
                        @else
                        Entregado
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('pedidoDetalle', [ 'id'=>$pedido->pedido_id.'-'.$pedido->pedido_user_id ]) }}" class="btn btn-info">
                            Detalle
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
