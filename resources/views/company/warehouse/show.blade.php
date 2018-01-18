@extends('layouts.app')

@section('panel_header')
    @lang('company.company_warehouse.title')
@endsection

@section('content')
    <div class="card">
        <header class="card-heading">
            <h2 class="card-title">{{ $data['companyWarehouse']->name }}</h2>
        </header>
        <div class="card-body p-t-0">
            <div class="card card-transparent m-b-0">
                <div class="card-body p-0">
                    <div class="tabpanel">
                        <ul class="nav nav-tabs">
                            <li class="active" role="presentation">
                                <a href="#tab-5" data-toggle="tab"
                                   aria-expanded="true">@lang('company.company_warehouse.home')</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-2" data-toggle="tab"
                                   aria-expanded="true">@lang('company.company_warehouse.addon.addons')</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-3" data-toggle="tab"
                                   aria-expanded="true">@lang('company.company_warehouse.fee_rules')</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-4" data-toggle="tab"
                                   aria-expanded="true">@lang('company.company_warehouse.orders.tab_name')</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content  p-20">
                        <div class="tab-pane fadeIn active" id="tab-5">
                            <label for="address">@lang('company.company_warehouse.title')</label>
                            <p>{{ $data['companyWarehouse']->address->formatted_address }}</p>
                        </div>
                        <div class="tab-pane fadeIn" id="tab-2">
                            @include('company.warehouse.addon.index')
                        </div>
                        <div class="tab-pane fadeIn" id="tab-3">
                            <section class="panel-group" id="fee-rules-parent" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    @include('company.warehouse.fee_rules._table')
                                    @include('company.warehouse.fee_rules.weight._table')
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane fadeIn" id="tab-4">
                            <div class="card card-data-tables product-table-wrapper">
                                <div class="card-body p-0">
                                    <table id="table-orders" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="col-sm-2" data-orderable="false">@lang('order.table_fragment.uuid')</th>
                                            <th class="col-sm-2">@lang('order.table_fragment.status')</th>
                                            <th data-orderable="false">@lang('order.table_fragment.invoice_status')</th>
                                            <th>@lang('order.table_fragment.updated_at')</th>
                                            <th data-orderable="false">@lang('order.table_fragment.amount')</th>
                                            <th data-orderable="false" class="col-xs-2">
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data['companyWarehouse']->warehouseOrders as $order)
                                            <tr>
                                                <td>{{ $order->uuid }}</td>
                                                <td><span class="label label-default">{{ $order->orderStatus->message }}</span></td>
                                                <td><span class="label label-default">{{ $order->invoiceOrder->first()->invoiceStatus->message }}</span></td>
                                                <td>{{Carbon\Carbon::parse($order->updated_at)->format('d/m/Y')}}</td>
                                                <td>$: {{ $order->total }} </td>
                                                <td>
                                                    <section id="sweet_alerts_card">
                                                        <a href="#" class="icon"
                                                           onclick="window.location='{{ route("admin.companies.warehouses.orders.show", [
                                                               $data['companyId'],
                                                               $data['companyWarehouse']->id,
                                                               $order->id
                                                           ]) }}'"
                                                           data-toggle="tooltip"
                                                           data-placement="top" title="@lang('buttons.titles.show')">
                                                            <i class="zmdi zmdi-search"></i>
                                                        </a>
                                                    </section>
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