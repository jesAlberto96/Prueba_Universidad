<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ResponseController;
use \App\Models\Estudiante;

class EstudiantesController extends Controller
{
    public $response;

    public function __construct(){
        $this->response = new ResponseController;
    }

    public function index()
    {
        return $this->response->sendResponse(Estudiante::all());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $data = Estudiante::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'tipoDocumento' => $request->tipoDocumento,
            'documento' => $request->documento,
            'genero' => $request->genero,
            'fechaNacimiento' => $request->fechaNacimiento,
            'carrera' => $request->carrera,
        ]);

        return $this->response->sendResponse($data, "Recurso creado correctamente");
    }

    public function validateForm(Request $request){
        $this->validate($request, [
            'nombres' => 'required',
            'apellidos' => 'required',
            'tipoDocumento' => 'required',
            'documento' => 'required',
            'genero' => 'required',
            'fechaNacimiento' => 'required',
            'carrera' => 'required',
        ], [
            'nombres.required' => 'El campo nombres son obligatorios',
            'apellidos.required' => 'El campo apellidos son obligatorios',
            'tipoDocumento.required' => 'El tipo de documento es obligatorio',
            'documento.required' => 'El documento es obligatorio',
            'genero.required' => 'El genero es obligatorios',
            'fechaNacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'carrera.required' => 'La carrera es obligatoria',
        ]);
    }

    public function show($id)
    {
        $data = Estudiante::find($id);

        if (is_null($data)) {
            return $this->response->sendError("Recurso no encontrado");
        }

        return $this->response->sendResponse($data);
    }

    public function edit($id)
    {
        $data = Estudiante::find($id);

        if (is_null($data)) {
            return $this->response->sendError("Recurso no encontrado");
        }

        return $this->response->sendResponse($data);
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        $data = Estudiante::find($id);
        if (is_null($data)) {
            return $this->response->sendError("Recurso no encontrado");
        }

        $data->nombres = $request->nombres;
        $data->apellidos = $request->apellidos;
        $data->tipoDocumento = $request->tipoDocumento;
        $data->documento = $request->documento;
        $data->genero = $request->genero;
        $data->fechaNacimiento = $request->fechaNacimiento;
        $data->carrera = $request->carrera;
        $data->save();

        return $this->response->sendResponse($data, "Recurso actualizado !!!");
    }

    public function destroy($id)
    {
        $data = Estudiante::find($id);
        if (is_null($data)) {
            return $this->response->sendError("Recurso no encontrado");
        }

        $data->delete();

        return $this->response->sendResponse([], "Recurso eliminado con exito !!!");
    }
}
