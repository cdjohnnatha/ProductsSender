@extends('layouts.app')


@section('panel_header')
    {{__('common.titles.companies')}}
@endsection

@section('content')
    <section class="content-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="card card-data-tables product-table-wrapper">
                    <header class="card-heading">
                        <h2 class="card-title">{{__('company.company_addons.title')}}</h2>
                        <small class="dataTables_info">All the addons in companies are listed here.</small>

                        <div class="card-search">
                            <div id="productsTable_wrapper" class="form-group label-floating is-empty">
                                <i class="zmdi zmdi-search search-icon-left"></i>
                                <input type="text" class="form-control filter-input" placeholder="Filter Products..." autocomplete="off">
                                <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip" data-placement="top" title="Close"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    </header>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="productsTable" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th data-orderable="false" class="col-xs-2">
                                        <a href="{{Route('admin.company-addons.create')}}">
                                            <button class="btn btn-primary btn-fab animate-fab"><i class="zmdi zmdi-plus"></i></button>
                                        </a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($addons as $addon)
                                    <tr>
                                        <td>{{$addon->id}}</td>
                                        <td>{{$addon->title}}</td>
                                        <td>{{$addon->company->name}}</td>
                                        <td>
                                            @include('layouts.formButtons._form_edit_delete', ['prefix_name' => 'admin.company-addons' ,'id' => $addon->id])
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
