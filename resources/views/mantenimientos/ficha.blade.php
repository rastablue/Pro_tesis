@extends('layouts.appTran')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-13">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Archivo de Ficha</b></h4></span>
                        <a href="javascript:history.back()">
                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                        </a>
                    </div>

                    <div class="card-body">
                            <img class="img-responsive img-rounded float-left" src="{{ $mantenimiento->url_path }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
