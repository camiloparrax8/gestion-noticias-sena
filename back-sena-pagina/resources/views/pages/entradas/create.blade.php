@extends('adminlte::page')

@section('title', 'Creación de entradas')

@section('content_header')
    <h1 class="mt-4">Crear de Entradas</h1>
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
                <h1>Crear Entrada</h1>
                <form action="{{ route('entradas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <div class="form-row mb-2">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Titulo en español:</label>
                                        <input type="text" name="titulo" value="{{ old('titulo') }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="titulo_ingles">Titulo en ingles:</label>
                                        <input type="text" name="titulo_ingles" value="{{ old('titulo_ingles') }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="titulo_emb">Titulo en embera:</label>
                                        <input type="text" name="titulo_emb" value="{{ old('titulo_emb') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion_corta">Descripción corta en español:</label>
                                        <input type="text" name="descripcion_corta"
                                            value="{{ old('descripcion_corta') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion_corta_ingles">Descripción corta en ingles:</label>
                                        <input type="text" name="descripcion_corta_ingles"
                                            value="{{ old('descripcion_corta_ingles') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion_corta_emb">Descripción corta en embera:</label>
                                        <input type="text" name="descripcion_corta_emb"
                                            value="{{ old('descripcion_corta_emb') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">



                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion_larga">Descripción larga:</label>
                                        <textarea class="form-control" name="descripcion_larga">{{ old('descripcion_larga') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion_larga_ingles">Descripción larga en ingles:</label>
                                        <textarea class="form-control" name="descripcion_larga_ingles">{{ old('descripcion_larga_ingles') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion_larga_emb">Descripción larga en embera:</label>
                                        <textarea class="form-control" name="descripcion_larga_emb">{{ old('descripcion_larga_emb') }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>





                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label for="autor">Autor:</label>
                            <select required name="autor" class="form-control">
                                <option value="">--seleccione un autor--</option>
                                @foreach ($autores as $autor)
                                    <option value="{{ $autor->id }}"
                                        {{ old('autor') == $autor->id ? 'selected' : '' }}>
                                        {{ $autor->nombre }} - {{ $autor->cargo }} - {{ $autor->profesion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label for="miniatura">Miniatura:</label>
                            <input name="miniatura" id="miniatura" aria-label="Upload" class="form-control" type="file"
                                id="formFile">
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div class="form-group">
                            <img src="{{ Storage::url('miniatura') }}"
                                style="width: -webkit-fill-available; height:-webkit-fill-available; padding-bottom: 10px;"
                                id="image_preview" hidden>
                        </div>
                    </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>










    </div>
    </div>

@endsection

@section('js')
    <script>
        const logo = document.getElementById('miniatura');
        const logoPreview = document.getElementById('image_preview');
        document.addEventListener("DOMContentLoaded", function() {
            logo.addEventListener('change', () => {
                if (logo.files && logo.files[0]) {
                    logoPreview.removeAttribute('hidden');
                    const file = logo.files[0];
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => {
                        logoPreview.src = reader.result;
                    }
                } else {
                    logoPreview.setAttribute('hidden', 'true');
                }
            });
        });
    </script>

@endsection
