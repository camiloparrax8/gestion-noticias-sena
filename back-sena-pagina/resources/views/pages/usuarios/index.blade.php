@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1 class="mt-4">Gestion de usuarios</h1>
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
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Crear usuario</a>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Nombre completo</th>
                            <th>cedula</th>
                            <th>celular</th>
                            <th>E-mail</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->nombre }} {{ $usuario->apellido }}</td>
                                <td>{{ $usuario->cedula }}</td>
                                <td>{{ $usuario->celular }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('usuarios.edit', $usuario->id) }}"><i
                                                class="fas fa-edit"></i> Editar</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-toggle="modal"
                                            data-target="#delete_{{ $usuario->id }}"><i class="fas fa-trash"></i>
                                            Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                            <!-- modal para eliminar usuarios  -->
                            <div class="modal fade" id="delete_{{ $usuario->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 id="titulo_delete" class="modal-title" id="exampleModalLabel">
                                                Eliminar usuario {{ $usuario->nombre }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="modal-text">¿Esta seguro que desea eliminar este usuario del
                                                sistema?</p>
                                            <p class="modal-text"> <b>Nota:</b> Tenga que cuenta que por cuestiones
                                                de seguridad y de integridad de datos, esta informacion no será
                                                eliminada totalmente, pero ya no aparecerá en los registros del
                                                sistema. Para recuperarla debe comunicarse con el soporte técnico.
                                            </p>
                                        </div>
                                        <form id="form_delete" action="{{ route('usuarios.destroy', $usuario->id) }}"
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
