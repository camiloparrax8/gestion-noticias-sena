@extends('adminlte::page')

@section('css')
    <style>
        .zoom {
            transition: transform .2s;
        }

        .zoom:hover {
            transform: scale(1.5);
        }
    </style>
@endsection

@section('title', 'Entradas')

@section('content_header')
    <h1 class="mt-4">Gestion de entradas</h1>
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

            <div class="container">

                <a href="{{ route('entradas.create') }}" class="btn btn-primary">Crear entrada</a>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Miniatura</th>
                            <th>Descripciones</th>
                            <th>Autor</th>
                            <th>Fecha de creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entradas as $entrada)
                            <tr>
                                <td> <b>Español:</b> {{ $entrada->titulo }} <br> <b>Ingles:</b>
                                    {{ $entrada->titulo_ingles }} <br> <b>Embera:</b> {{ $entrada->titulo_emb }} </td>
                                <td>
                                    <img class="ver_imagen zoom" src="{{ Storage::url($entrada->miniatura) }}"
                                        alt="" style="cursor:pointer; cursor: hand;  height: 50px; width: 50px;  ">
                                </td>
                                <td>
                                    <a href="" data-toggle="modal"
                                        data-target="#descripciones_{{ $entrada->id }}"><button class="btn btn-primary"><i
                                                class="fas fa-eye"></i></button></a>
                                </td>
                                <td>{{ $entrada->autor->nombre }}</td>
                                <td>{{ $entrada->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-grid"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('entradas.edit', $entrada->id) }}"><i
                                                class="fas fa-edit"></i> Editar</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-toggle="modal"
                                            data-target="#delete_{{ $entrada->id }}"><i class="fas fa-trash"></i>
                                            Eliminar</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('entradas.show', $entrada->id) }}"><i
                                                class="fas fa-image"></i> Galería</a>
                                    </div>
                                </td>
                            </tr>
                            <!-- modal para eliminar entradas  -->
                            <div class="modal fade" id="delete_{{ $entrada->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 id="titulo_delete" class="modal-title" id="exampleModalLabel">Eliminar
                                                entrada {{ $entrada->titulo }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="modal-text">¿Esta seguro que desea eliminar esta entrada del sistema?
                                            </p>
                                            <p class="modal-text"> <b>Nota:</b> Tenga que cuenta que por cuestiones de
                                                seguridad y de integridad de datos, esta informacion no será eliminada
                                                totalmente, pero ya no aparecerá en los registros del sistema. Para
                                                recuperarla debe comunicarse con el soporte técnico.</p>
                                        </div>
                                        <form id="form_delete" action="{{ route('entradas.destroy', $entrada->id) }}"
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
                            <!-- modal para descripciones-->
                            <div class="modal fade" id="descripciones_{{ $entrada->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Descripciones de la entrada
                                                {{ $entrada->titulo }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <x-adminlte-card title="Descripción corta en español" theme="blue"
                                                collapsible="collapsed">
                                                {{ $entrada->descripcion_corta }}
                                            </x-adminlte-card>
                                            <x-adminlte-card title="Descripción larga en español" theme="blue"
                                                collapsible="collapsed">
                                                {{ $entrada->descripcion_larga }}
                                            </x-adminlte-card>
                                            <x-adminlte-card title="Descripción corta en ingles" theme="blue"
                                                collapsible="collapsed">
                                                {{ $entrada->descripcion_corta_ingles }}
                                            </x-adminlte-card>
                                            <x-adminlte-card title="Descripción larga en ingles" theme="blue"
                                                collapsible="collapsed">
                                                {{ $entrada->descripcion_larga_ingles }}
                                            </x-adminlte-card>
                                            <x-adminlte-card title="Descripción corta en embera" theme="blue"
                                                collapsible="collapsed">
                                                {{ $entrada->descripcion_corta_emb }}
                                            </x-adminlte-card>
                                            <x-adminlte-card title="Descripción larga en embera" theme="blue"
                                                collapsible="collapsed">
                                                {{ $entrada->descripcion_larga_emb }}
                                            </x-adminlte-card>
                                            <!-- <div class="row">
                                                        <div class="col-5 col-sm-3">
                                                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                                                <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Español {{ $entrada->id }}</a>
                                                                <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Inglés {{ $entrada->id }}</a>
                                                                <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Embera {{ $entrada->id }}</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-7 col-sm-9">
                                                            <div class="tab-content" id="vert-tabs-tabContent">
                                                                <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                                                    <h5>Descripción corta</h5>
                                                                    <p class="modal-text">{{ $entrada->descripcion_corta }}</p>
                                                                    <h5>Descripción larga</h5>
                                                                    <p class="modal-text">{{ $entrada->descripcion_larga }}</p>
                                                                </div>
                                                                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                                                    <h5>Descripción corta en ingles</h5>
                                                                    <p class="modal-text">{{ $entrada->descripcion_corta_ingles }}</p>
                                                                    <h5>Descripción larga en ingles</h5>
                                                                    <p class="modal-text">{{ $entrada->descripcion_larga_ingles }}</p>
                                                                </div>
                                                                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                                                    <h5>Descripción corta en embera</h5>
                                                                    <p class="modal-text">{{ $entrada->descripcion_corta_emb }}</p>
                                                                    <h5>Descripción larga en embera</h5>
                                                                    <p class="modal-text">{{ $entrada->descripcion_larga_emb }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal para descripciones en ingles-->
                            <!-- <div class="modal fade" id="desc_ing_{{ $entrada->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 id="titulo_delete" class="modal-title" id="exampleModalLabel">Descripciones en ingles de la entrada {{ $entrada->titulo }}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Descripción corta</h5>
                                                    <p class="modal-text">{{ $entrada->descripcion_corta_ingles }}</p>
                                                    <h5>Descripción larga</h5>
                                                    <p class="modal-text">{{ $entrada->descripcion_larga_ingles }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                            <!-- modal para descripciones en embera-->
                            <!-- <div class="modal fade" id="desc_emb_{{ $entrada->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 id="titulo_delete" class="modal-title" id="exampleModalLabel">Descripciones en embera de la entrada {{ $entrada->titulo }}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Descripción corta</h5>
                                                    <p class="modal-text">{{ $entrada->descripcion_corta_emb }}</p>
                                                    <h5>Descripción larga</h5>
                                                    <p class="modal-text">{{ $entrada->descripcion_larga_emb }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                            <!-- modal de ver imagen -->
                            <div class="modal fade m-0" id="imagemodal" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img class="zoom" src="" id="imagepreview"
                                                style="width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

            </div>












        </div>
    </div>


@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.ver_imagen').on('click', function() {
                let ruta_imagen = $(this).attr('src');
                $('#imagepreview').attr('src', ruta_imagen);
                $('#imagemodal').modal('show');
            });

        });
    </script>
@endsection
