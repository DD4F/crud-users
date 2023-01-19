@extends('layouts.dashboard.app')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand la la-building"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Listado De usuarios
                </h3>
            </div>

            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="{{ route('users.create') }}" class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" >
                            <i class="flaticon2-plus"></i> Nuevo Usuario
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <!--begin: Search Form -->
                <form action="{{ route('users.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-2 ">
                            <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
                                <div class="m-messenger__form">
                                    <div class="m-messenger__form-controls">
                                        <select class="form-control kt-selectpicker"
                                            name="categoria_id" id="categoria_id"
                                            data-size="7" data-live-search="true" tabindex="-98">
                                            <option value="">Seleccione</option>
                                            @foreach ($categorias as $categoria)
                                                @if ($categoria->id == request()->categoria_id )
                                                    <option value="{{$categoria->id}}" selected>
                                                        {{$categoria->nombre}}
                                                    </option>
                                                @else
                                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
                                <div class="m-messenger__form">
                                    <div class="m-messenger__form-controls">
                                        <select class="form-control kt-selectpicker"
                                            name="countrie_id" id="countrie_id"
                                            data-size="7" data-live-search="true" tabindex="-98">
                                            <option value="">Seleccione</option>
                                            @foreach ($countries as $countrie)
                                                @if ($countrie->id == request()->countrie_id )
                                                    <option value="{{$countrie->id}}" selected>
                                                        {{$countrie->nombre}}
                                                    </option>
                                                @else
                                                    <option value="{{$countrie->id}}">
                                                        {{$countrie->nombre}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
                                <div class="m-messenger__form">
                                    <div class="m-messenger__form-controls">
                                        <input type="text" name="search" class="form-control m-messenger__form-input" placeholder="Buscar..." id="search" value="{{ request()->search }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn m-btn--pill btn-outline-primary"> <i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </form>
            <!--end: Search Form -->
        </div>

        <div class="kt-portlet__body">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <!-- Estart table Companies -->
                <div class="card-body">

                    @if ( $users->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No. Identificación</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Pais</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach( $users as $key => $user)
                                    <tr>
                                        <th scope="col">{{ $key+1 }}</th>
                                        <td>{{ $user->identificacion }}</td>
                                        <td>{{ $user->nombres }}</td>
                                        <td>{{ $user->apellidos }}</td>
                                        <td>{{ $user->countrie->nombre }}</td>
                                        <td>{{ $user->categoria->nombre }}</td>
                                        <td>{{ $user->direccion }}</td>
                                        <td>{{ $user->celular }}</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else
                        <h2> No existen usuarios registrados</h2>
                    @endif
                </div>
                <!-- End table Companies -->
            </div>
        </div>

    </div>

@endsection
