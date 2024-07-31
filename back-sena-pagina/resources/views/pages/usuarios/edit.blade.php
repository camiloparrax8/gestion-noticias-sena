@extends('adminlte::page')

@section('title', 'Edición de usuarios')

@section('content_header')
    <h1 class="mt-4">Editar Usuario: <b>{{ $usuario->nombre }}</b></h1>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            @if (session()->has('type'))
                <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                    {{ session('message') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="container">

                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="number" name="id" value="{{ $usuario->id }}" class="form-control" hidden>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" value="{{ $usuario->nombre }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" value="{{ $usuario->apellido }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="cedula">Cedula:</label>
                                <input type="number" name="cedula" value="{{ $usuario->cedula }}" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="celular">Celular:</label>
                                <input type="number" name="celular" value="{{ $usuario->celular }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" name="email" value="{{ $usuario->email }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>


@endsection
