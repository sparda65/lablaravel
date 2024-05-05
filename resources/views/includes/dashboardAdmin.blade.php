<p>
    Aqui aparecen todos los prestamos realizados.
    Cuando alguien solicite material debera de enseñar un documento con los datos del usuario
    y el material solicitado, el prestamo aparecera aqui
    <br>
    Si quiere ver los detalles del prestamo oprima el boton de "Detalles"
    <br>
    Cuando alguien entregue el material al laboratorio usted debe de dar de baja el prestamo y recirlo, para eso
    oprima el boton de "Entregar"
</p>
@if(count($pedidos) == 0)
No hay prestamos
@else

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
                    @if($pedido->pedido_estado == '1')
                    <a href="{{ route('pedidoEntregar', [ 'id'=>$pedido->pedido_id.'-'.$pedido->pedido_user_id ]) }}" class="btn btn-warning">
                        Entregar
                    </a>
                    @endif
                </td>
            </tr>
        @endforeach
        
    </tbody>
</table>
@endif