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
                                <p>Mostrar Producto</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route ('product.index') }}"></a>
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
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion:') }}</label>
                                <div class="col-md-6">
                                    <input id="desciption" type="desciption" class="form-control" name="desciption" value="{{ $dato->desciption }}" readonly>
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
