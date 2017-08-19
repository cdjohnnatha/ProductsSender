@extends('layouts._template')

@section('content')


<div class="content-body">
<div class="row">
<div class="col-xs-12">
<div class="card card-data-tables product-table-wrapper">
    <header class="card-heading">

        <h2 class="card-title">Admins</h2>
        <small class="dataTables_info">All the admins which can use the application are here.</small>

        <div class="card-search">
            <div id="productsTable_wrapper" class="form-group label-floating is-empty">
                <i class="zmdi zmdi-search search-icon-left"></i>
                <input type="text" class="form-control filter-input" placeholder="Filter Products..." autocomplete="off">
                <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip" data-placement="top" title="Close"><i class="zmdi zmdi-close"></i></a>
            </div>
        </div>
        <ul class="card-actions icons right-top">
            <li id="deleteItems" style="display: none;">
                <span class="label label-info pull-left m-t-5 m-r-10 text-white"></span>
                <a href="javascript:void(0)" id="confirmDelete" data-toggle="tooltip" data-placement="top" data-original-title="Delete Product(s)">
                    <i class="zmdi zmdi-delete"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" data-card-search="open" data-toggle="tooltip" data-placement="top" data-original-title="Filter Products">
                    <i class="zmdi zmdi-filter-list"></i>
                </a>
            </li>
            <li class="dropdown" data-toggle="tooltip" data-placement="top" data-original-title="Show Entries">
                <a href="javascript:void(0)" data-toggle="dropdown">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <div id="dataTablesLength">
                </div>
            </li>
            <li>
                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="Export All">
                    <i class="zmdi zmdi-inbox"></i>
                </a>
            </li>
        </ul>
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
                    <th data-orderable="false" class="col-xs-1">
                <span class="checkbox">
                  <label>
                    <input type="checkbox" value="" id="checkAll">
                    <span class="checkbox-material"></span>
                  </label>
                </span>
                    </th>
                    <th>Id</th>
                    <th>{{ __('admin.form.name') }}</th>
                    <th>{{ __('admin.form.surname') }}</th>
                    <th>{{ __('admin.form.country') }}</th>
                    <th>Email</th>
                    <th>{{ __('admin.form.phone') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->surname}}</td>
                        <td>{{$admin->country}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->phone}}</td>
                        <td>
                            @include('layouts.formButtons._form_edit_delete', $admin->id);
                        </td>
                    </tr>
                @endforeach
                {{--<tr>--}}
                    {{--<td class="checkbox-cell">--}}
                {{--<span class="checkbox">--}}
                  {{--<label>--}}
                    {{--<input type="checkbox" value="" id="">--}}
                    {{--<span class="checkbox-material"></span>--}}
                  {{--</label>--}}
                {{--</span>--}}
                    {{--</td>--}}
                    {{--<td><img src="assets/img/ecom/products/12252_Tgi0.jpeg" alt="" class="img-thumbnail" /></td>--}}
                    {{--<td>Grunt</td>--}}
                    {{--<td>#394822</td>--}}
                    {{--<td>$32</td>--}}
                    {{--<td>--}}
                        {{--<div class="togglebutton">--}}
                            {{--<label>--}}
                                {{--<input type="checkbox" class="toggle-info" checked>--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--</td>--}}
                    {{--<td>1,200</td>--}}
                    {{--<td>--}}
                        {{--<a href="javascript:void(0)" class="edit-product icon"><i class="zmdi zmdi-edit"></i></a>--}}
                        {{--<a href="javascript:void(0)" class="edit-product icon"><i class="zmdi zmdi-delete"></i></a>--}}

                    {{--</td>--}}
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="panel-heading">Admin</div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>{{ __('admin.form.name') }}</th>
                <th>{{ __('admin.form.surname') }}</th>
                <th>{{ __('admin.form.country') }}</th>
                <th>Email</th>
                <th>{{ __('admin.form.phone') }}</th>
                <th>{{ __('admin.form.actions') }}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->surname}}</td>
                        <td>{{$admin->country}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->phone}}</td>
                        <td>
                            <div class="col-sm-4">
                                <a href="{{route('admin.edit', $admin->id)}}" class="edit-modal btn btn-warning">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    {{ __('buttons.titles.edit') }}
                                </a>
                            </div>
                            <form action="{{route('admin.destroy', $admin->id)}}" method="POST"  role="form" class="col-sm-8">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" id="delete-{{$admin->id}}" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    {{ __('buttons.titles.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
