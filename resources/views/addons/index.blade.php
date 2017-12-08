@extends('layouts.app')

@section('panel_header')
    {{__('common.titles.services')}}
@endsection


@section('content')
<section class="content-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="card card-data-tables product-table-wrapper">
                <header class="card-heading">
                    <h2 class="card-title">{{__('common.titles.services')}}</h2>
                    <small class="dataTables_info">{{__('common.short_description.main', [ 'entity' => __('common.titles.services') ])}}</small>

                    <div class="card-search">
                        <div id="productsTable_wrapper" class="form-group label-floating is-empty">
                            <i class="zmdi zmdi-search search-icon-left"></i>
                            <input type="text" class="form-control filter-input" placeholder="Filter Products..." autocomplete="off">
                            <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip" data-placement="top" title="Close"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                    <ul class="card-actions icons right-top">
                        <li>
                            <a href="javascript:void(0)" data-card-search="open" data-toggle="tooltip" data-placement="top" data-original-title="Filter Products">
                                <i class="zmdi zmdi-filter-list"></i>
                            </a>
                        </li>
                    </ul>
                </header>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="productsTable" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="col-sm-1">Id</th>
                                <th class="col-sm-2">Title</th>
                                <th class="col-sm-1">Price</th>
                                <th class="col-sm-2">Short description</th>
                                <th data-orderable="false" class="col-xs-2">
                                    <a href="{{Route('admin.services.create')}}">
                                        <button class="btn btn-primary btn-fab  animate-fab"><i class="zmdi zmdi-plus"></i></button>
                                    </a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($services)
                                @foreach($services as $service)
                                    <tr>
                                        <td>{{$service->id}}</td>
                                        <td>{{$service->title}}</td>
                                        <td>{{$service->price}}</td>
                                        <td>{{$service->description}}</td>
                                        <td>
                                            @include('layouts.formButtons._form_edit_delete', ['prefix_name' => 'admin.services' ,'id' => $service->id])
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection