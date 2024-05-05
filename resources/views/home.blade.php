@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @role('admin')
                        @include('includes.dashboardAdmin', ['pedidos' => $pedidos])
                    @endrole

                    @role('alumno')
                        @include('includes.dashboardAlumno', ['pedidos' => $pedidos])
                    @endrole
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
