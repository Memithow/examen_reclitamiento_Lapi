@extends('layouts.app')

@section('template_title')
    Empleados
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between"><strong class="align-self-center">{{ __('Empleados') }}</strong> <button class="btn btn-primary" onclick="showModal()">Nuevo empleado</button></div>
                    <div class="card-body table-responsive">
                        <div class="row my-3">
                            <div class="col-6">
                                <div class="row">
                                    <label for="mensaje" class="col-5 col-form-label">Mostar salario de forma: </label>
                                    <div class="col">
                                        <select class="form-control" id="salario-opcion" onchange="empleados_tabla.ajax.reload()">
                                            <option value="m">Mensual</option>
                                            <option value="q">Quincenal</option>
                                            <option value="s">Semanal</option>
                                            <option value="d">Diaria</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <label for="">Descargar informe: </label>
                                <a class="btn btn-success mx-3" href="{{ route('reportes.downloadPDF') }}">PDF</a>
                                <a class="btn btn-info mx-3" href="{{ route('reportes.dowloadExcel') }}">Excel</a>
                            </div>
                        </div>
                        <hr>
                        <table id="tabla-empleados" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Correo</th>
                                    <th>Salario</th>
                                    <th>Puesto</th>
                                    <th>Estatus</th>
                                    <th>Creado</th>
                                    <th>Actualizado</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-empleados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="empleados_modal.modal('hide')"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="empleados_modal.modal('hide')">Cerrar</button>
                    <button type="button" class="btn btn-danger visually-hidden" id="btn-delete" onclick="eliminar()">Eliminar</button>
                    <button type="button" class="btn btn-primary" onclick="guardar()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="application/javascript">
        var empleados_tabla, mensajes_automaticos_tabla, empleados_modal;
        var btn_delete = document.getElementById('btn-delete');

        window.onload = ()=> {
            empleados_modal = $('#modal-empleados');

            $('#tabla-empleados thead tr').clone(true).addClass('filters').appendTo('#tabla-empleados thead');

            empleados_tabla = $('#tabla-empleados').DataTable({
                orderCellsTop: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                ajax: {
                    url: "{{ URL::to('empleados') }}?json=1",
                    error: function (xhr, error, thrown) {
                        document.querySelector('#tabla-empleados tbody').innerHTML = "<tr><td>No se encontraron registros</td></tr>"
                    }
                },
                fixedHeader: true,
                initComplete: function () {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title + '" />');

                            // On every keypress in this input
                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('change', function (e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function (e) {
                                    e.stopPropagation();

                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
                createdRow: function( row, data, dataIndex ) {
                    row.dataset.id = data.id;
                    row.style.cursor = 'pointer';
                    row.classList.add('modal-empleados');
                },
                columns: [
                    {data: "id", orderable: true},
                    {data: "nombre", orderable: true},
                    {data: "apellidos", orderable: true},
                    {data: 'correo', orderable: true},
                    {
                        data: 'salario',
                        render(data){
                            let s_diario = data/30;
                            let option_selected = document.querySelector('#salario-opcion').selectedOptions[0].value;
                            let salario;
                            switch (option_selected){
                                case 'm': salario = data; break;
                                case 'q': salario = s_diario*15; break;
                                case 's': salario = s_diario*7; break;
                                case 'd': salario = s_diario; break;
                            }
                            return Number.parseFloat(salario).toFixed(2);
                        },
                        orderable: true
                    },
                    {data: 'puesto', orderable: true},
                    {data: 'estatus', orderable: true},
                    {
                        data: "created_at",
                        render(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY H:MM');
                        }
                    },
                    {
                        data: "updated_at",
                        render(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY H:MM');
                        }
                    }
                ],
            });

            $('#tabla-empleados tbody').on('click', 'tr', function () {
                showModal(this.dataset.id)
            });
        }

        function showModal(id = null) {
            let html = `<form id="empleado-form">
                <input type="hidden" name="id">
                <div class="row mb-3">
                    <div class="col">
                        <label for="mensaje" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre">
                    </div>
                    <div class="col">
                        <label for="mensaje" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="mensaje" class="form-label">Puesto</label>
                        <input type="email" class="form-control" name="puesto">
                    </div>
                    <div class="col">
                        <label for="mensaje" class="form-label">Salario mensual</label>
                        <input type="email" class="form-control" name="salario">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="mensaje" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo">
                    </div>
                    <div class="col">
                        <label for="mensaje" class="form-label">Estatus</label>
                        <select class="form-control" name="estatus">
                            <option>Habilitado</option>
                            <option>Deshabilitado</option>
                        </select>
                    </div>
                </div>
            </form>`;
            document.querySelector('#modal-empleados .modal-body').innerHTML = html;
            btn_delete.classList.add('visually-hidden');
            if(id){
                fetch('{{ URL::to('empleados') }}/'+id, {
                    method: 'GET',
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(res => res.json())
                .then(res => {
                    let form = document.querySelector('#empleado-form').elements;
                    form.id.value = res.data.id;
                    form.nombre.value = res.data.nombre;
                    form.apellidos.value = res.data.apellidos;
                    form.correo.value = res.data.correo;
                    form.salario.value = res.data.salario;
                    form.puesto.value = res.data.puesto;
                    form.estatus.value = res.data.estatus;
                    btn_delete.classList.remove('visually-hidden');
                });
            }
            empleados_modal.modal('show');
        }

        function guardar(){
            let form = document.querySelector('#empleado-form');
            let route = form.elements.id.value ? '{{ URL::to('empleados') }}/'+form.elements.id.value : '{{ URL::to('empleados') }}';
            let method = form.elements.id.value ? 'PUT' : 'POST';
            let formData = new FormData(form);

            btn_delete.classList.add('visually-hidden');
            fetch(route, {
                method: method,
                body: JSON.stringify(Object.fromEntries(formData)),
                headers:{
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(res => res.json())
            .then(res => {
                alert(form.elements.id.value ? 'Usuario actualizado con éxito.' : 'Usuario creado con éxito.');
                empleados_modal.modal('hide');
                empleados_tabla.ajax.reload();
            });
        }

        function eliminar(){
            let form = document.querySelector('#empleado-form');
            if(form.id.value){
                if(confirm('¿Estas seguro de querer eliminar al empleado?')){
                    fetch('{{ URL::to('empleados') }}/'+form.id.value, {
                        method: 'DELETE',
                        headers:{
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(res => res.json())
                        .then(res => {
                            alert('Empleado eliminado');
                            empleados_modal.modal('hide');
                            empleados_tabla.ajax.reload();
                            btn_delete.classList.add('visually-hidden');
                        });
                }
            }else
                btn_delete.classList.add('visually-hidden');
        }
    </script>
@endsection
