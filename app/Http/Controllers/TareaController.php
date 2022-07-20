<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tareas;
use App\Models\Category;

class TareaController extends Controller
{
    //index para mostrar todos los elemento
    public function index(){
        $tareas = Tareas::all();
        $categories = Category::all();
        return view('tareas.index', ['tareas' => $tareas, 'categories' => $categories]);

    }
    //store para guardar todo
    public  function store(Request $request){
        $request -> validate([
            'title' => 'required|min:3'
        ]);

        $tarea = new Tareas;
        $tarea->title = $request->title;
        $tarea->category_id = $request->category_id;

        $tarea->save();

        return redirect()->route('tareas')->with('success', 'Tarea creada correctamente');

    }

    public function show($id){
        $tarea = Tareas::find($id);
        return view('tareas.show', ['tarea' => $tarea]);

    }

    public function update(Request $request, $id){
        $tarea = Tareas::find($id);
        $tarea->title = $request->title;
        $tarea->save();

        //return view('tareas.index', ['success' => 'Tarea actualizada']);
        return redirect()->route('tareas')->with('success', 'Tarea actualizada');


    }

    public function destroy($id){
        $tarea = Tareas::find($id);
        $tarea->delete();

        return redirect()->route('tareas')->with('success', 'Tarea eliminada');


      

    }


    //update para actualizar todo
    //destroy para eleiminar todo
    //edit para mostrar el formulario de edición
}
