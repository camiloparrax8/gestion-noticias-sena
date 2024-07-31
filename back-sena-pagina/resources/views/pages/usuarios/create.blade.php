@extends('adminlte::page')

@section('title', 'Creación de usuarios')

@section('content_header')
    <h1 class="mt-4">Cear usuario</h1>
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

                <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="cedula">Cedula:</label>
                                <input type="number" name="cedula" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="celular">Celular:</label>
                                <input type="number" name="celular" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="email">Correo electrónico:</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>

        </div>
    </div>


@endsection
