<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <style>
        body{
            font-size: 0.6rem;
        }
    </style>
    <title>Reporte de empleados</title>
</head>
<body>
    <h1 class="fw-bolder text-center">Reporte de Empleados</h1>
        <div class="row">
            <div class="col">
                <h3 class="fw-bolder my-3">Empleados Habilitados</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Salario Mensual</th>
                            <th>Puesto</th>
                        </tr>
                    </thead>
                    <?php foreach($empleados as $empleado) {
                        if($empleado['estatus'] == 'Habilitado'){ ?>
                            <tr>
                                <td> <?php echo $empleado['id']; ?> </td>
                                <td> <?php echo $empleado['nombre']; ?> </td>
                                <td> <?php echo $empleado['apellidos']; ?> </td>
                                <td> <?php echo $empleado['correo']; ?> </td>
                                <td> <?php echo $empleado['salario']; ?> </td>
                                <td> <?php echo $empleado['puesto']; ?> </td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3 class="fw-bolder my-3">Empleados Deshabilitados</h3>
                <table class="table table-bordered">
                    <tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Salario Mensual</th>
                            <th>Puesto</th>
                        </tr>
                    </thead>
                    <?php foreach($empleados as $empleado){
                        if($empleado['estatus'] == 'Deshabilitado'){ ?>
                            <tr>
                                <td> <?php echo $empleado['id']; ?> </td>
                                <td> <?php echo $empleado['nombre']; ?> </td>
                                <td> <?php echo $empleado['apellidos']; ?> </td>
                                <td> <?php echo $empleado['correo']; ?> </td>
                                <td> <?php echo $empleado['salario']; ?> </td>
                                <td> <?php echo $empleado['puesto']; ?> </td>
                            </tr>
                        <?php }
                    } ?>
                </table>
            </div>

        </div>


</body>
</html>
