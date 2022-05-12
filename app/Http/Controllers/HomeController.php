<?php

namespace App\Http\Controllers;

use App\Models\MensajesAutomaticos;
use Illuminate\Http\Request;
use App\Models\RandomData;
use App\Models\TareasProgramadas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('home');
    }

    public function registrosAleatorios(){
        $random_data = RandomData::get();

        return response()->json(['data' => $random_data]);
    }

    public function mensajesAutomaticos(){
        return view('mensajes_automaticos');
    }

    public function mensajesGuardados(){
        $mensajes = MensajesAutomaticos::get();

        return response()->json(['data' => $mensajes]);
    }

    public function tareasProgramadas(){
        $tareas = TareasProgramadas::get();

        return response()->json(['data' => $tareas]);
    }

    public function guardarMensaje(Request $request){
        $nueva_tarea = new TareasProgramadas();
        $nueva_tarea->mensaje = $request->mensaje;
        $nueva_tarea->hora = $request->hora;
        $nueva_tarea->save();

        return response()->json(['status' => true]);
    }
}
