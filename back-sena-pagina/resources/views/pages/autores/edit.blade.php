@extends('adminlte::page')

@section('title', 'Título de la página')

@section('content_header')
    <h1 class="mt-4">Editar autor: <b>{{ $autor->nombre }}</b></h1>
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

                <form action="{{ route('autores.update', $autor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $autor->nombre }}" required>
                    </div>
                    <div class="form-group">
                        <label for="cargo">Cargo:</label>
                        <input type="text" name="cargo" class="form-control" value="{{ $autor->cargo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="profesion">Profesión:</label>
                        <input type="text" name="profesion" class="form-control" value="{{ $autor->profesion }}"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>











        </div>
    </div>


@endsection
