@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
            <div class="card">
                <div class="card-header">{{ __('Solicitar Prestamo') }}</div>

                <div class="card-body">
                    <p>
                        Por favor, marque las casillas de los materiales que desee utilizar, cuando termine presione el boton de "Solicitar"<br>
                        Se te enviara un correo electronico con un archivo, el cual debes de presentar para que sea entregado el material solicitado.<br>
                        Si hay un material que no este en la lista es probable que alguien mas lo haya solicitado y aun no lo ha regresado

                    </p>
                    <form method="POST" action="{{ route('pedidoRegistro') }}">
                        @csrf
                        <br>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success col-md-6" value="Solicitar">
                                Solicitar
                                </button>
                            </div>
                        </div>
                        <br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Solicitar</th>
                                    <th scope="col">id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materiales as $material)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="check_material[]" value="{{$material->material_id}}">
                                    </td>
                                    <td>{{ $material->material_id }}</td>
                                    <td>{{ $material->material_name }}</td>
                                    
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
                                </tr>
                                @endforeach
                            </tbody>
                        </table>    
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
