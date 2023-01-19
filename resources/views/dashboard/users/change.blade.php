@extends('layouts.dashboard.app')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand la la-building"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Configurar Usuario
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <!-- Estart table  -->
                <div class="card-body">
                    <!--begin::Form-->
                    @include('partials.errors')
                    <form class="kt-form kt-form--label-right" action="{{ route('users.changeuser') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Identificacion :</label>
                                    <input type="text" class="form-control"
                                        name="identificacion" id="identificacion"
                                        placeholder="NIT ó Identificación">
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Nuevo Email:</label>
                                    <input type="email" class="form-control"
                                        name="new_email" id="new_email"
                                        placeholder="Ingrese su email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Contraseña:</label>
                                    <input type="password" class="form-control"
                                        name="password" id="password"
                                        placeholder="Ingrese la contraseña">
                                </div>
                            </div>

                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <a href="{{route('users.index')}}" class="btn btn-brand">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->

                </div>
                <!-- End table  -->
            </div>
        </div>

    </div>

@endsection
