@extends('layouts.app')

@section('template_title')
    Home
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body d-flex justify-content-around">
                    <a class="btn btn-secondary" href="{{ route('users') }}">Usuarios</a><button onclick="createDatatablesRegistros()" class="btn btn-secondary" href="{{ route('users') }}">Registros Automaticos</button><a class="btn btn-secondary" href="{{ route('mensajesAutomaticos') }}">Tareas Programadas</a>
                </div>
            </div>
            <div class="card visually-hidden my-5 overflow-auto" id="tabla-registros">
                <div class="card-header">Tabla de registros automáticos</div>
                <div class="card-body">
                    <table id="tabla" class="table table-responsive">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>uid</th>
                                <th>valid_card</th>
                                <th>token</th>
                                <th>invalid_card</th>
                                <th>month</th>
                                <th>year</th>
                                <th>ccv</th>
                                <th>ccv_amex</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="application/javascript">
        var datatables = null;

        function createDatatablesRegistros(){
            if(!datatables){
                datatables = $('#tabla').DataTable( {
                    processing: true,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },
                    ajax: {
                        url: "{{ route('registrosAleatorios') }}",
                        error: function (xhr, error, thrown) {
                            document.querySelector('#tabla-registros tbody').innerHTML = "<tr><td>No se encontraron registros</td></tr>"
                        }
                    },
                    columns: [
                        { data: "id" },
                        { data: "uid" },
                        { data: "valid_card" },
                        { data: "token" },
                        { data: "invalid_card" },
                        { data: "month" },
                        { data: "year" },
                        { data: "ccv" },
                        { data: "ccv_amex" },
                        {
                            data: "created_at",
                            render(data, type, row, meta) {
                                return moment(data).format('DD-MM-YYYY H:MM');;
                            }
                        }, {
                            data: "updated_at",
                            render(data, type, row, meta) {
                                return moment(data).format('DD-MM-YYYY H:MM');;
                            }
                        }
                    ],
                } );
                document.getElementById('tabla-registros').classList.remove('visually-hidden');
            }else{
                datatables.ajax.reload();
            }


        }
    </script>
@endsection
