@extends('adminlte::page')

@section('title', 'Multimedia')

@section('content_header')
    <h1 class="mt-4">Archivos de: <b>{{ $entrada->titulo }}</b> </h1>
@endsection
@section('content')
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
    <div class="card">
        <div class="card-body">

            <form action="{{ route('storeMultimedia') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-2">
                    <input type="number" name="id_entrada" value="{{ $entrada->id }}" hidden>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="tipo">Tipo de archivo:</label>
                            <select id="tipo" name="tipo" class="form-control">
                                <option value="">--seleccione un tipo de archivo--</option>
                                <option value="video">Video(URL de YouTube)</option>
                                <option value="imagen">Imagen</option>
                                <option value="audio">Audio</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group" id="imagen_audio_mostrar">
                            <label for="url">Archivo:</label>
                            <input name="url" id="archivo" aria-label="Upload" class="form-control" type="file"
                                id="formFile">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="{{ Storage::url('miniatura') }}"
                                        style="width: -webkit-fill-available; height:-webkit-fill-available; padding-bottom: 10px;"
                                        id="image_preview" hidden>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="url_video_mostrar">
                            <label for="url">Url:</label>
                            <input name="url_video" id="url_video" class="form-control" type="text">

                        </div>


                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo de archivo</th>
                        <th>URL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($multimedias as $multimedia)
                        <tr>
                            <td>{{ $multimedia->tipo }}</td>
                            <td><a href="{{ asset($multimedia->url) }}" target="_blank">{{ asset($multimedia->url) }}</a>
                            </td>
                            <td><a data-toggle="modal" data-target="#delete_{{ $multimedia->id }}"><button
                                        class="btn btn-danger">Eliminar</button></a></td>
                        </tr>
                        <div class="modal fade" id="delete_{{ $multimedia->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 id="titulo_delete" class="modal-title" id="exampleModalLabel">Eliminar
                                            contenido multimedia</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p class="modal-text">¿Esta seguro que desea eliminar este contenido multimedia
                                            del sistema?</p>
                                    </div>
                                    <form id="form_delete" action="{{ route('destroyMultimedia', $multimedia->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal"><i
                                                    class="flaticon-cancel-12"></i> Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#tipo').on('change', function() {
                var tipo_archivo = $('#tipo').val();
                if (tipo_archivo == "imagen") {

                }
            });
        });
        const logo = document.getElementById('archivo');
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
    <script>
        document.getElementById('tipo').addEventListener('change', function() {
            var tipo = this.value;
            var imagenAudioMostrar = document.getElementById('imagen_audio_mostrar');
            var urlVideoMostrar = document.getElementById('url_video_mostrar');

            if (tipo === 'imagen' || tipo === 'audio') {
                imagenAudioMostrar.style.display = 'block';
                urlVideoMostrar.style.display = 'none';
            } else if (tipo === 'video') {
                imagenAudioMostrar.style.display = 'none';
                urlVideoMostrar.style.display = 'block';
            } else {
                imagenAudioMostrar.style.display = 'none';
                urlVideoMostrar.style.display = 'none';
            }
        });
    </script>
@endsection

@section('css')

    <style>
        #imagen_audio_mostrar,
        #url_video_mostrar {
            display: none;
        }
    </style>
@endsection
