<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntradaRequest;
use App\Http\Requests\MultimediaRequest;
use App\Models\Autor;
use App\Models\Entrada;
use App\Models\MultimediaEntrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entradas = Entrada::where('is_delete', 0)->get();
        return view('pages.entradas.index', compact('entradas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $autores = Autor::where('is_delete', 0)->get();
        return view('pages.entradas.create', compact('autores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntradaRequest $request)
    {
        $miniatura_path = '';
        if ($request->hasFile('miniatura')) {
            if ($request->hasFile('miniatura')) {
                $nombre_imagen = $request->file('miniatura')->getClientOriginalName();
                $miniatura_path = $request->file('miniatura')->storeAs('entradas/miniaturas', $nombre_imagen, 'public');
            }
        }
        $entrada = new Entrada();
        $entrada->titulo = $request->titulo;
        $entrada->titulo_ingles = $request->titulo_ingles;
        $entrada->titulo_emb = $request->titulo_emb;
        $entrada->descripcion_corta = $request->descripcion_corta;
        $entrada->descripcion_larga = $request->descripcion_larga;
        $entrada->descripcion_corta_ingles = $request->descripcion_corta_ingles;
        $entrada->descripcion_larga_ingles = $request->descripcion_larga_ingles;
        $entrada->descripcion_corta_emb = $request->descripcion_corta_emb;
        $entrada->descripcion_larga_emb = $request->descripcion_larga_emb;
        $entrada->id_autor = $request->autor;
        $entrada->miniatura = $miniatura_path;
        $entrada->id_usuario = 1;
        if ($entrada->save()) {
            return redirect()->route('entradas.index')->with(['type' => 'success', 'message' => '¡Entrada registrada con éxito!']);
        }else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al registrar la entrada!']);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $entrada = Entrada::find($id);
        $multimedias = MultimediaEntrada::where('id_entrada', $id)->get();
        return view('pages.entradas.multimedia', compact('entrada','multimedias'));
    }

    public function descripciones(){
        $entrada = Entrada::select( 'id','titulo', 'descripcion_corta', 'descripcion_larga', 'miniatura')->where('is_delete', 0)->get();

        return response()->json($entrada, 200);
    }

    public function descripciones_ingles(){
        $entrada = Entrada::select( 'id', 'titulo_ingles', 'descripcion_corta_ingles', 'descripcion_larga_ingles', 'miniatura')->where('is_delete', 0)->get();
        return response()->json($entrada, 200);
    }

    public function descripciones_embera(){
        $entrada = Entrada::select( 'id', 'titulo_emb', 'descripcion_corta_emb', 'descripcion_larga_emb', 'miniatura')->where('is_delete', 0)->get();
        return response()->json($entrada, 200);
    }

    public function get_multimedia($id){
        $multimedias = MultimediaEntrada::select('tipo', 'url')->where('id_entrada', $id)->get();
        return response()->json($multimedias, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $autores = Autor::where('is_delete', 0)->get();
        $entrada = Entrada::find($id);
        return view('pages.entradas.edit', compact('entrada', 'autores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntradaRequest $request, $id)
    {
       
        $entrada = Entrada::find($id);
        $entrada->titulo = $request->titulo;
        $entrada->titulo_emb = $request->titulo_emb;
        $entrada->titulo_ingles = $request->titulo_ingles;
        $entrada->descripcion_corta = $request->descripcion_corta;
        $entrada->descripcion_larga = $request->descripcion_larga;
        $entrada->descripcion_corta_ingles = $request->descripcion_corta_ingles;
        $entrada->descripcion_larga_ingles = $request->descripcion_larga_ingles;
        $entrada->descripcion_corta_emb = $request->descripcion_corta_emb;
        $entrada->descripcion_larga_emb = $request->descripcion_larga_emb;
        $entrada->id_autor = $request->autor;
        if ($request->hasFile('miniatura')) {
            // Delete old image
            if ($entrada->miniatura) {
                Storage::delete($entrada->miniatura);
            }
            // Store image
            $nombre_imagen = $request->file('miniatura')->getClientOriginalName();
            $image_path = $request->file('miniatura')->storeAs('entradas/miniaturas', $nombre_imagen, 'public');
            // Save to Database
            $entrada->miniatura = $image_path;
        }
        if ($entrada->save()) {
            return redirect()->route('entradas.index')->with(['type' => 'success', 'message' => '¡Entrada actualizada con éxito!']);
        }else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al actualizar los datos de la entrada!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entrada=Entrada::find($id);
        $entrada->is_delete = 1;
        $entrada->delete_at = now();
        if ($entrada->save()) {
            return redirect()->back()->with(['type' => 'success', 'message' => '¡Entrada eliminada con éxito!']);
        }else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al eliminar los datos de la entrada!']);
        }
    }


}
