<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function CrearTarea(Request $request)
    {
        //Validacion
        $validacion = [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'materia' => 'required|string|max:100',
            'fecha_entrega' => 'required|date',
        ];

        //Validar datos
        $validar_datos = $request->validate($validacion);

        //Insertar datos en tabla tareas
        Tarea::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'materia' => $request->materia,
            'fecha_entrega' => $request->fecha_entrega,
        ]);

        return redirect()->route('VerTareas')->with('success', 'Tarea creada correctamente');
    }

    public function ver_formulario()
    {
        return view('tareas.formulario');
    }

    //Funcion para ver todas las tareas
    public function VerTareas(Request $request)
    {
        $tareas = Tarea::orderBy('fecha_entrega', 'asc')->paginate(5);

        return view('tareas.index', compact('tareas'));
    }

    //Funcion para ver una tarea por id
    public function VerTarea($id)
    {
        $tarea = Tarea::find($id);

        return response()->json(['message' => 'La tarea buscada es:', 'tarea' => $tarea]);
    }

    public function delete_tarea($id)
    {
        $tarea = Tarea::find($id);

        if ($tarea) {
            $tarea->delete();
            return redirect()->route('VerTareas')->with('success', 'Tarea eliminada correctamente');
        } else {
            return redirect()->route('VerTareas')->with('error', 'Tarea no encontrada');
        }
    }


    public function update_tarea(Request $request, $id)
    {
        $tarea = Tarea::where('id', $id);

        $tarea->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'materia' => $request->materia,
            'fecha_entrega' => $request->fecha_entrega,
        ]);

        return redirect()->route('VerTareas')->with('success', 'Tarea ha sido actualizada');
    }
}
