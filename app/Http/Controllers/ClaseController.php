<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clases = Clase::orderBy('id', 'desc')->get();
        return response()->json($clases, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar
        $request->validate([
            "nombre"=> "required|unique:clases"
        ]);
        //guardar
        $clase = new Clase();
        $clase->nombre = $request->nombre;
        $clase->detalle = $request->detalle;
        $clase->save();
        //responder
        return response()->json(["message" => "Clase Registrada"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clase = Clase::find($id);
        return response()->json($clase, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validar
        $request->validate([
            "nombre"=> "required|unique:clases,nombre,$id" //ignora el id
        ]);
        //Actualizamos datos
        $clase = Clase::find($id);
        $clase->nombre = $request->nombre;
        $clase->detalle = $request->detalle;
        $clase->update();
        return response()->json(["message" => "Clase Modificada"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clase = Clase::find($id);
        $clase->delete();
        return response()->json(["message" => "Clase Eliminada"], 200);
    }
}
