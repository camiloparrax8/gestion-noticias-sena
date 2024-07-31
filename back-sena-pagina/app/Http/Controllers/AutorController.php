<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorRequest;
use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::where('is_delete', 0)->get();
        return view('pages.autores.index', compact('autores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.autores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AutorRequest $request)
    {
        $autor = new Autor();
        $autor->nombre = $request->input('nombre');
        $autor->cargo = $request->input('cargo');
        $autor->profesion = $request->input('profesion');
        if ($autor->save()) {
            return redirect()->route('autores.index')->with(['type' => 'success', 'message' => '¡Autor registrado con éxito!']);
        }else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al registrar el autor!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Autor $autor)
    {
        return view('autores.show', compact('autor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $autor = Autor::find($id);
        return view('pages.autores.edit', compact('autor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $autor = Autor::find($id);
        $autor->nombre = $request->input('nombre');
        $autor->cargo = $request->input('cargo');
        $autor->profesion = $request->input('profesion');
        if ($autor->save()) {
            return redirect()->route('autores.index')->with(['type' => 'success', 'message' => '¡Autor actualizado con éxito!']);
        }else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al actualizar los datos del autor!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $autor=Autor::find($id);
        $autor->is_delete = 1;
        $autor->delete_at = now();
        if ($autor->save()) {
            return redirect()->back()->with(['type' => 'success', 'message' => '¡Autor eliminado con éxito!']);
        }else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al eliminar los datos del autor!']);
        }
    }
}
