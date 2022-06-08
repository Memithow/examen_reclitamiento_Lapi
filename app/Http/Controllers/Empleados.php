<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\EmpleadosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Empleados as ModelEmpleados;

class Empleados extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->json)
            return response()->json(['data' => ModelEmpleados::get()]);
        else
            return view('empleados');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = new ModelEmpleados;
        $empleado->nombre = $request->nombre;
        $empleado->apellidos = $request->apellidos;
        $empleado->correo = $request->correo;
        $empleado->salario = $request->salario;
        $empleado->puesto = $request->puesto;
        $empleado->estatus = $request->estatus;
        $empleado->save();

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['data' => ModelEmpleados::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empleado = ModelEmpleados::find($id);
        $empleado->nombre = $request->nombre;
        $empleado->apellidos = $request->apellidos;
        $empleado->correo = $request->correo;
        $empleado->salario = $request->salario;
        $empleado->puesto = $request->puesto;
        $empleado->estatus = $request->estatus;
        $empleado->save();

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = ModelEmpleados::find($id);
        $empleado->delete();

        return response()->json([
            'status' => true
        ]);
    }

    public function downloadPDF(){
        $empleados = ModelEmpleados::get()->toArray();

        $pdf = PDF::loadView('pdf.empleados', ['empleados' => $empleados])->setPaper('a4', 'portrait');
        return $pdf->download('ReporteEmpleados.pdf');
    }

    public function downloadExcel(){
        return Excel::download(new EmpleadosExport, 'ReporteEmpleados.xlsx');
    }
}
