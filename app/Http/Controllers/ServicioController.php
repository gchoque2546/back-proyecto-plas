<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // http://127.0.0.1:8000/api/servicio?page=5&q=tec
        $buscar = isset($request->q)?$request->q : '';
        $limit = isset($request->limit)?$request->limit: 10;

        if($buscar){
            $servicios = Servicio::orderBy('id', 'desc')
                                    ->where('nombre', 'like', '%'.$buscar.'%')
                                    ->with("clase")
                                    ->paginate($limit);
        }else{
            $servicios = Servicio::orderBy('id', 'desc')->with("clase")->paginate($limit);
        }
        return response()->json($servicios, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar
        $request->validate([
            "nombre" => "required",
            "clase_id" => "required"
        ]);
        //guardar
        $serv = new Servicio();
        $serv->nombre = $request->nombre;
        $serv->precio = $request->precio;
        $serv->clase_id = $request->clase_id;
        $serv->descripcion = $request->descripcion;
        $serv->save();
        //responder
        return response()->json(["message" => "Servicio Registrado"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
