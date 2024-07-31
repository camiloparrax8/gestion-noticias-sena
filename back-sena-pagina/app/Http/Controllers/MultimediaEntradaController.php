<?php

namespace App\Http\Controllers;

use App\Http\Requests\MultimediaRequest;
use App\Models\MultimediaEntrada;
use Illuminate\Http\Request;

class MultimediaEntradaController extends Controller
{
    public function storeMultimedia(MultimediaRequest $request)
    {
        $url_path = '';
        $multimedia = new MultimediaEntrada();
    
        if ($request->hasFile('url')) {
            $nombre_imagen = $request->file('url')->getClientOriginalName();
            $url_path = $request->file('url')->storeAs('entradas/multimedia', $nombre_imagen, 'public');
            $multimedia->url = 'storage/' . $url_path;
        } else {
            $multimedia->url = $request->get('url_video');
        }
    
        $multimedia->tipo = $request->tipo;
        $multimedia->id_entrada = $request->id_entrada;
    
        if (empty($multimedia->url)) {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡El archivo multimedia no puede estar vacío!']);
        }
    
        if ($multimedia->save()) {
            return redirect()->back()->with(['type' => 'success', 'message' => '¡Archivo multimedia registrado con éxito!']);
        } else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al registrar el archivo multimedia!']);
        }
    }

    public function destroyMultimedia($id)
    {
        $multimedia = MultimediaEntrada::find($id);
        if ($multimedia->delete()) {
            return redirect()->back()->with(['type' => 'success', 'message' => '¡Contenido multimedia eliminada con éxito!']);
        } else {
            return redirect()->back()->with(['type' => 'danger', 'message' => '¡Error al eliminar los datos del contenido multimedia!']);
        }
    }
}
