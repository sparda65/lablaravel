@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            <div class="card">
                <div class="card-header">{{ __('Editar Material') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ActualizarMaterial') }}">
                        @csrf
                        <input type="hidden" name="material_id" value="{{ $material->material_id }}">

                        <div class="row mb-3">
                            <label for="matname" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="matname" type="text" class="form-control @error('name') is-invalid @enderror" name="matname" value="{{ $material->material_name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">
                                Descripcion
                            </label>
                            <div class="col-md-6">
                                <textarea type="text" id="description" name="description" class="form-control" required>{{ $material->material_descripcion }}</textarea>        
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Estado') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="estado" aria-label="Default select example" required>
                                    <option value="1"@if($material->material_estado == '1') selected  @endif>Nuevo</option>
                                    <option value="2"@if($material->material_estado == '2') selected  @endif>Bueno</option>
                                    <option value="3"@if($material->material_estado == '3') selected  @endif>Regular</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Actualizar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
