<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::where('is_delete', 0)->get();
        return view('pages.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {
        $usuario = new User();
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->cedula = $request->cedula;
        $usuario->celular = $request->celular;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->cedula);
        if ($usuario->save()) {
            return redirect()->route('usuarios.index')->with(['type' => 'success', 'message' => '¡Usuario registrado con éxito!']);
        }else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al registrar el usuario!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario=User::find($id);
        return view('pages.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioRequest $request, $id)
    {
        $usuario=User::find($id);
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->celular = $request->celular;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->cedula);
        if ($usuario->save()) {
            return redirect()->route('usuarios.index')->with(['type' => 'success', 'message' => '¡Usuario editado con éxito!']);
        }else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al editar el usuario!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario=User::find($id);
        $usuario->is_delete = 1;
        $usuario->delete_at = now();
        if ($usuario->save()) {
            return redirect()->back()->with(['type' => 'success', 'message' => '¡Usuario eliminado con éxito!']);
        }else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al eliminar los datos del usuario!']);
        }
    }
}
