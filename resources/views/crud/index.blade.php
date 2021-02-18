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
                                <p>Tabla de usuarios</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        @can('create user')
                        <a href="{{route('crud.create')}}" class="btn btn-success">Nuevo Usuario</a>
                        @endcan
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                        <br>
                                <table class="table table-bordered  table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">email</th>
                                            <th scope="col">Rol</th>
                                            <th scope="col">Opción</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($dato as $dato)
                                            <tr>
                                                <td>{{$dato->id}}</td>
                                                <td>{{$dato->name}}</td>
                                                <td>{{$dato->email}}</td>
                                                <td>{{$dato->roles->implode('name',',')}}</td>
                                                <td>
                                                    <form method="post" action="{{ route ('crud.destroy', $dato->id)}}" style="display: inline-block">
                                                        @can('show user')
                                                        <a href="{{route('crud.show', $dato->id)}}" class="btn btn-primary">Show</a>
                                                        @endcan
                                                        @can('update user')
                                                        <a href="{{route('crud.edit', $dato->id)}}" class="btn btn-warning">Edit</a>
                                                        @endcan
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('delete user')
                                                        <button class="btn btn-danger" type="submit">Eliminar</button>
                                                        @endcan
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
