<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
        $servicio = Servicio::with('clase')->findOrFail($id);
        return response()->json($servicio, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validar
        $request->validate([
            "nombre" => "required",
            "clase_id" => "required"
        ]);
        $serv = Servicio::findOrFail($id);
        //editar
        $serv->nombre = $request->nombre;
        $serv->precio = $request->precio;
        $serv->clase_id = $request->clase_id;
        $serv->descripcion = $request->descripcion;
        $serv->update();
        //responder
        return response()->json(["message" => "Servicio Actualizado"], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //buscar
        $serv = Servicio::findOrFail($id);
        //eliminar
        $serv->delete();
        return response()->json(["message" => "Servicio Eliminado"], 200);
    }

    public function actualizarImagen(Request $request, $id) {
        if($file = $request->file("imagen")){
            $direccion_imagen = time()."-".$file->getClientOriginalName();
            $file->move("imagen/", $direccion_imagen);
            $direccion_imagen = "imagen/". $direccion_imagen;

            $serv = Servicio::find($id);
            $serv->imagen = $direccion_imagen;
            $serv->update();
            return response()->json(["message" => "Imagen Servicio Actualizado"], 200);
        }
        return response()->json(["message" => "Se requiere Imagen de Servicio"], 422);
    }
}
