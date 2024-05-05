<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet" type="text/css" >
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/source.js') }}"></script>

    


</head>
<body>
    <div id="app">
        <main class="py-4">
	        <?php 
			$date =  new DateTime($pedido->pedido_fec_pre);
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
			                    <br><br>

			                    <!-- FIN informacion pretamo -->

			                    <p>
			                    	Por medio de la presente solicito el siguiente material y me comprometo a no hacer mal uso del mismo, entregandolo en el mismo estado en el que me fue prestado.
			                    </p>

			                    <!-- materiales prestamo -->

			                    <table class="table table-striped" style="margin-top:30px ;">
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
        </main>
    </div>
</body>
</html>
