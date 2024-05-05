@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Materiales') }}</div>

                <div class="card-body">
                   <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Disponibilidad</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materiales as $material)
                            <tr>
                                <th scope="row">{{ $material->material_id }}</th>
                                <td>{{ $material->material_name }}</td>
                                <td>
                                    @if($material->material_disponibilidad == '1')
                                        {{ __('Disponible') }}
                                    @else
                                        {{ __('ocupado') }}
                                    @endif
                                </td>
                                <td>
                                    @switch($material->material_estado)
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
                                <td>
                                    <a href="{{ route('EditarMaterial', [ 'id'=>$material->material_id ]) }}" class="btn btn-warning">Editar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
