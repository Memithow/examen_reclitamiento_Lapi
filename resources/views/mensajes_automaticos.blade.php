@extends('layouts.app')

@section('template_title')
    Tareras programadas
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between"><strong class="align-self-center">{{ __('Tareas Programadas') }}</strong> <button class="btn btn-primary" onclick="showModal()">Agragar nueva tarea</button></div>
                    <div class="card-body">
                        <table id="tabla-tareas-programadas" class="table table-responsive">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Mensaje</th>
                                <th>Hora</th>
                                <th>Fecha de creación</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between"><strong class="align-self-center">{{ __('Mensajes automáticos generados') }}</strong> <button class="btn btn-primary" onclick="mensajes_automaticos_tabla.ajax.reload()">Recargar tabla</button></div>
                    <div class="card-body">
                        <table id="tabla-mensajes-automaticos" class="table table-responsive">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Mensaje</th>
                                <th>Fecha de creación</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-tareas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generar nueva tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="guardar()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="application/javascript">
        var tareas_prgramadas_tabla, mensajes_automaticos_tabla, tareas_modal;
        window.onload = ()=> {
            tareas_modal = $('#modal-tareas');
            tareas_prgramadas_tabla = $('#tabla-tareas-programadas').DataTable({
                processing: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                ajax: {
                    url: "{{ route('tareasProgramadas') }}",
                    error: function (xhr, error, thrown) {
                        document.querySelector('#tabla-registros tbody').innerHTML = "<tr><td>No se encontraron registros</td></tr>"
                    }
                },
                columns: [
                    {data: "id"},
                    {data: "mensaje"},
                    {data: "hora"},
                    {
                        data: "created_at",
                        render(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY H:MM');;
                        }
                    },
                ],
            });
            mensajes_automaticos_tabla = $('#tabla-mensajes-automaticos ').DataTable({
                processing: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                ajax: {
                    url: "{{ route('mensajesGuardados') }}",
                    error: function (xhr, error, thrown) {
                        document.querySelector('#tabla-registros tbody').innerHTML = "<tr><td>No se encontraron registros</td></tr>"
                    }
                },
                columns: [
                    {data: "id"},
                    {data: "mensaje"},
                    {
                        data: "created_at",
                        render(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY H:MM');
                        }
                    },
                ],
            });

        }

        function showModal() {
            tareas_modal.modal('show');
            let html = `<form id="nuevo-mensaje-form">
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje automatico a mostrar</label>
                        <input type="text" class="form-control" id="mensaje" name="mensaje">
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje automatico a mostrar</label>
                        <input class="form-control" type="text" name="hora" id="datetime"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                    </div>
                </form>`;

            document.querySelector('#modal-tareas .modal-body').innerHTML = html;

            $('#datetime').timepicker({
                timeFormat: 'H:mm',
                interval: 5,
                defaultTime: '00:00',
                startTime: '00:00',
                dropdown: true,
                scrollbar: true
            });
        }

        function guardar(){
            let form = document.querySelector('#nuevo-mensaje-form');
            if(form.elements.mensaje.value && form.elements.hora.value){
                let formData = new FormData(form);
                fetch('{{route('guardarMensaje')}}', {
                    method: 'POST',
                    body: JSON.stringify(Object.fromEntries(formData)),
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(res => res.json())
                .then(res => {
                    alert('Nueva tarea agregada.');
                    tareas_modal.modal('hide');
                    tareas_prgramadas_tabla.ajax.reload();
                })
            }else{
                alert('Se deben llenar todos los campos.')
            }

        }
    </script>
@endsection
