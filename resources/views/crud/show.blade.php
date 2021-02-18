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
                                <p>Mostrar Usuario</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route ('crud.index') }}"></a>
                    <div class="card-body">
                        <br>
                        <div class="text text-center"><h2>Mostrar</h2></div>
                        <br>
                        <hr>
                        <br>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre:') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="name" class="form-control" name="name" value="{{ $dato->name }}"  readonly>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $dato->email }}" readonly >
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                <i class="fa fa-lock"></i>{{ __(' Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" value="{{ $dato->email }}" name="password" readonly>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Rol:') }}</label>
                                <div class="col-md-6">
                                    <select class="custom-select" id="inputGroupSelect01" name="rol" id="rol">
                                        @foreach($rol as $key => $value)
                                        @if ($dato->hasRole($value))
                                            <option  value="{{ $value }}" selected>{{ $value }}</option>
                                        @endif

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>
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
