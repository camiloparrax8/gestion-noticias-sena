@extends('adminlte::page')

@section('title', 'Autores')

@section('content_header')
    <h1 class="mt-4">Gestion de autores</h1>
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
                <a href="{{ route('autores.create') }}" class="btn btn-primary">Crear Autor</a>
                <table class="table  mt-4">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Profesión</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($autores as $autor)
                            <tr>
                                <td>{{ $autor->nombre }}</td>
                                <td>{{ $autor->cargo }}</td>
                                <td>{{ $autor->profesion }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-grid"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('autores.edit', $autor->id) }}"><i
                                                class="fas fa-edit"></i> Editar</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-toggle="modal"
                                            data-target="#delete_{{ $autor->id }}"><i class="fas fa-trash"></i>
                                            Eliminar</a>
                                    </div>
                                    <!-- {{-- <a href="{{ route('autores.show', $autor->id) }}" class="btn btn-info">Ver</a> --}}
                                        {{-- <a href="{{ route('autores.edit') }}" class="btn btn-warning">Editar</a> --}}
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('autores.edit', $autor->id) }}" class="btn btn-primary">Editar</a>
                                            <a data-toggle="modal" data-target="#delete_{{ $autor->id }}"><button class="btn btn-danger">Eliminar</button></a>
                                        </div> -->
                                </td>
                            </tr>
                            <!-- modal para eliminar autores  -->
                            <div class="modal fade" id="delete_{{ $autor->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 id="titulo_delete" class="modal-title" id="exampleModalLabel">Eliminar Autor
                                                {{ $autor->nombre }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="modal-text">¿Esta seguro que desea eliminar este autor del sistema?
                                            </p>
                                            <p class="modal-text"> <b>Nota:</b> Tenga que cuenta que por cuestiones de
                                                seguridad y
                                                de integridad de datos, esta informacion no será eliminada totalmente, pero
                                                ya no
                                                aparecerá en los registros del sistema. Para recuperarla debe comunicarse
                                                con el
                                                soporte técnico.</p>
                                        </div>
                                        <form id="form_delete" action="{{ route('autores.destroy', $autor->id) }}"
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
    </div>

@endsection
