@extends('layouts.app')

@section('panel_header')
    Admins of Holyship
@endsection

@section('content')
<section class="content-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="card card-data-tables product-table-wrapper">
                <header class="card-heading">
                    <h2 class="card-title">Admins</h2>
                    <small class="dataTables_info">All the admins which can use the application are here.</small>
                </header>
                <div class="card-body p-0">
                    <div class="alert alert-info m-20 hidden-md hidden-lg" role="alert">
                        <p>
                            Heads up! You can Swipe table Left to Right on Mobile devices.
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table id="productsTable" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                </th>
                                <th class="col-xs-1">Id</th>
                                <th class="col-xs-2">Email</th>
                                <th data-orderable="false" class="col-xs-2">
                                    <a href="{{Route('admin.create')}}">
                                        <button class="btn btn-primary btn-fab  animate-fab"><i class="zmdi zmdi-plus"></i></button>
                                    </a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->email}}</td>
                                    <td>
                                        @include('layouts.formButtons._form_edit_delete', ['prefix_name' => 'admin' ,'id' => $admin->id])
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
</section>
@endsection
