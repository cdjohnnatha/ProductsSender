
@extends('layouts.app')


@section('panel_header')
   {{__('plans.index.header')}}
@endsection


@section('content')
<section class="content-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="card card-data-tables product-table-wrapper">
                <header class="card-heading">
                    <h2 class="card-title">{{__('plans.index.title')}}</h2>
                    <small class="dataTables_info">{{__('plans.index.short_description')}}</small>

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
                            <a href="javascript:void(0)" id="confirmDelete" data-toggle="tooltip" data-placement="top"
                               data-original-title="Delete Product(s)">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-card-search="open" data-toggle="tooltip" data-placement="top"
                               data-original-title="Filter Products">
                                <i class="zmdi zmdi-filter-list"></i>
                            </a>
                        </li>
                        <li class="dropdown" data-toggle="tooltip" data-placement="top"
                            data-original-title="Show Entries">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>
                            <div id="dataTablesLength">
                            </div>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top"
                               data-original-title="Export All">
                                <i class="zmdi zmdi-inbox"></i>
                            </a>
                        </li>
                    </ul>
                </header>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="productsTable" class="mdl-data-table product-table m-t-30" cellspacing="0"
                               width="100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{__('common.titles.titles')}}</th>
                                    <th>{{__('common.titles.amount')}}</th>
                                    <th data-orderable="false" class="col-xs-2">
                                        <a href="{{Route('admin.subscriptions.create')}}">
                                            <button class="btn btn-primary btn-fab  animate-fab">
                                                <i class="zmdi zmdi-plus"></i>
                                            </button>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($subscriptions as $subscription)
                                <tr>
                                    <td>{{$subscription->id}}</td>
                                    <td>{{$subscription->title}}</td>
                                    <td>$ {{$subscription->amount}}</td>
                                    <td>
                                        @include('layouts.formButtons._form_edit_delete', ['prefix_name' => 'admin.subscriptions' ,'id' => $subscription->id])
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
