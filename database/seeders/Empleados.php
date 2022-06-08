<?php

namespace Database\Seeders;

use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Empleados as ModelEmpleados;


class Empleados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $puestos = ['Gerente', 'Empleado general', 'Desarrollo', 'TI', 'RH', 'Finanzas', 'Web analytics'];
        $estado = ['Habilitado', 'Deshabilitado'];

        for ($i = 1; $i <= 100; $i++) {
            $empleado = new ModelEmpleados;
            $empleado->nombre = Str::random(10);
            $empleado->apellidos = Str::random(10). ' '. Str::random(10);
            $empleado->correo = Str::random(10) . '@gmail.com';
            $empleado->salario = rand(3000,30000);
            $empleado->puesto = $puestos[rand(0, count($puestos)-1)];
            $empleado->estatus = $estado[rand(0, count($estado)-1)];
            $empleado->save();
        }
    }
}
