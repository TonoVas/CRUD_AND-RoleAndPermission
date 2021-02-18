@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper text-center">
                                <p>Editar Usuario</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                        @endif

                        <br>
                        <div class="text text-center"><h2>Editar</h2></div>
                        <br>
                        <hr>
                        <br>
                        <form method="POST" action="{{route('crud.update', $dato->id)}}">
                            @csrf
                            @method('PUT')
                            <br>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre:') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $dato->name }}"  >
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $dato->email }}" >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                <i class="fa fa-lock"></i>{{ __(' Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                    <i class="fa fa-lock"></i>{{ __(' Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol:') }}</label>
                                <div class="col-md-6">
                                    <select class="custom-select" id="inputGroupSelect01" name="rol" id="rol">
                                        @foreach($rol as $key => $value)
                                            @if ($dato->hasRole($value))
                                                <option  value="{{ $value }}" selected>{{ $value }}</option>
                                            @else
                                                <option  value="{{ $value }}" >{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-0 text-center">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enviar Formulario') }}
                                    </button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
