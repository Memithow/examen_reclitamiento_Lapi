@extends('layouts.app')

@section('template_title')
    Home
@endsection

@section('head')
    <!-- Scripts-->
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body row d-flex justify-content-center">
                    <div class="col-3 border border-1 text-center p-4 m-4">
                        <a class="text-dark fw-bolder" href="{{ route('users') }}">
                            <img class="mb-3" width="100px" height="114px" src="{{ asset('img/users-solid.svg') }}" alt="">
                            <br>Usuarios
                        </a>
                    </div>

                    <div class="col-3 border border-1 text-center p-4 m-4">
                        <a class="text-dark fw-bolder" href="{{ route('empleados.index') }}">
                            <img class="mb-3" width="100px" src="{{ asset('img/user-tie-solid.svg') }}" alt="">
                            <br>Empleados
                        </a>
                    </div>

                    <div class="col-3 border border-1 text-center p-4 m-4">
                        <button class="btn text-dark fw-bolder" onclick="createDatatablesRegistros()">
                            <img class="mb-3" width="100px" src="{{ asset('img/list-check-solid.svg') }}" alt="">
                            <br>Registros automáticos
                        </button>
                    </div>

                    <div class="col-3 border border-1 text-center p-4 m-4">
                        <a class="text-dark fw-bolder" href="{{ route('mensajesAutomaticos') }}">
                            <img class="mb-3" width="100px" src="{{ asset('img/clock-solid.svg') }}" alt="">
                            <br>Tareas Programadas
                        </a>
                    </div>

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
