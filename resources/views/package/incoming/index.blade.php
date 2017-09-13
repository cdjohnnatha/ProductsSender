@extends('layouts.app')

@section('panel_header')
    {{__('common.titles.incoming_package')}}
@endsection


@section('content')
    <section class="card">
        <header class="card-body p-0">
            <div class="tabpanel">
                <ul class="nav nav-tabs nav-tabs-right">
                    <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab" aria-expanded="true">{{__('common.titles.incoming')}}</a></li>
                    <li class="presentation" role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">{{__('common.titles.warehouse')}}</a></li>
                </ul>
            </div>
        </header>
        <header class="card-heading">
            <h2 class="card-title">{{__('common.titles.incoming_package')}}</h2>
            <small class="dataTables_info">{{__('common.short_description.main', ['entity' => 'incoming package'])}}</small>

        </header>

        <section class="tab-content  p-20">

            <section class="tab-pane fadeIn active" id="tab-1">
                <div class="row">
                    <div class="card card-data-tables product-table-wrapper">
                        <div class="card-body p-0">
                            @include('package.incoming._table', ['table_id' => 'incoming'])
                        </div>
                    </div>
                </div>
            </section>

            <section class="tab-pane fadeIn" id="tab-2">
                <div class="row">
                    <div class="card card-data-tables product-table-wrapper">
                        <div class="card-body p-0">
                            {{--@include('package._table', ['packages' => $packages_warehouse, 'table_id' => 'productsTable-warehouse'])--}}
                        </div>
                    </div>
                </div>
            </section>

        </section>
@endsection