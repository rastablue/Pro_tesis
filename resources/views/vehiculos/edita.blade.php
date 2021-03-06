@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><h4><b>Actualizar Vehiculo: </b></h4><i>{{ $vehiculo->first()->placa }}</i></span>
                        <a href="javascript:history.back()">
                            <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                        </a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('vehiculos.update', $vehiculo->first()->id) }}">
                            @method('PUT')
                            @csrf

                            {{-- Placa --}}
                                <div class="form-group row">
                                    <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Placa') }}</label>

                                    <div class="col-md-6">
                                        <input id="placa" placeholder="{{ $vehiculo->first()->placa }}" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" value="{{ $vehiculo->first()->placa }}" required autocomplete="placa" autofocus>

                                        @error('placa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Marca --}}
                                <div class="form-group row">
                                    <label for="tipovehis_id" class="col-md-4 col-form-label text-md-right">{{ __('Marca de Vehiculo') }}</label>

                                    <div class="col-md-6">

                                        <select id="marca" class="form-control" name="marca">
                                            <option value="{{ $vehiculo->first()->marcas->id }}" selected='true'>{{$vehiculo->first()->marcas->marca }}</option>
                                            @foreach(App\MarcaVehiculo::all() as $marcas)
                                                <option value="{{ $marcas->id }}">  {{ $marcas->marca }}  </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                            {{-- Modelo --}}
                                <div class="form-group row">
                                    <label for="modelo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>

                                    <div class="col-md-6">
                                        <input id="modelo" placeholder="{{ $vehiculo->first()->modelo }}" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" value="{{ $vehiculo->first()->modelo }}" required autocomplete="modelo" autofocus>

                                        @error('modelo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Color --}}
                                <div class="form-group row">

                                    <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                                    <div class="col-md-6">
                                        <input id="color" placeholder="{{ $vehiculo->first()->color }}" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ $vehiculo->first()->color }}" required autocomplete="color" autofocus>

                                        @error('color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Kilometraje --}}
                                <div class="form-group row">
                                    <label for="kilometraje" class="col-md-4 col-form-label text-md-right">{{ __('Kilometraje') }}</label>

                                    <div class="col-md-6">
                                        <input id="kilometraje" type="text" placeholder="{{ $vehiculo->first()->kilometraje }}" pattern="[0-9]{0, 6}" class="form-control @error('kilometraje') is-invalid @enderror" name="kilometraje" value="{{ $vehiculo->first()->kilometraje }}" required autocomplete="kilometraje" autofocus>

                                        @error('kilometraje')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Observaciones --}}
                                <div class="form-group row">
                                    <label for="observa" class="col-md-4 col-form-label text-md-right">{{ __('Observaciones') }}</label>

                                    <div class="col-md-6">
                                        <input id="observa" placeholder="{{ $vehiculo->first()->observacion }}" type="text" class="form-control @error('observa') is-invalid @enderror" name="observa" value="{{ $vehiculo->first()->observacion }}" required autocomplete="observaciones" autofocus>

                                        @error('observa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            {{-- Cedula del cliente --}}
                                <div class="form-group row">
                                    <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Cedula del Cliente') }}</label>
                                    @foreach ($user as $users)
                                        <div class="col-md-6">
                                            <input id="user_id" pattern="[0-9]{10}" placeholder="{{ $users->first()->cedula }}" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ $users->first()->cedula }}" required autocomplete="user_id" autofocus>

                                            @error('user_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>

                            {{-- btn --}}
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-5">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Actualizar') }}
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
