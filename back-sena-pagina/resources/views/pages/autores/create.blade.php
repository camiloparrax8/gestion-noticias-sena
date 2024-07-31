@extends('adminlte::page')

@section('title', 'Creación de autores')

@section('content_header')
    <h1 class="mt-4">Crear de autor</h1>
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
                <h1>Crear Autor</h1>
                <form action="{{ route('autores.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cargo">Cargo:</label>
                        <input type="text" name="cargo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="profesion">Profesión:</label>
                        <input type="text" name="profesion" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>












        </div>
    </div>


@endsection
