<?php

namespace App\Exports;

use App\Models\Empleados;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpleadosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Empleados::all();
    }

    public function headings(): array
    {
        return ['ID','Nombre','Apellidos','Correo','Salario mensual','Puesto','Estatus','Fecha de creación','Última modificación'];
    }
}
