@extends('layouts.app')

@section('panel_header')
    @lang('order.index.orders')
@endsection


@section('content')
    <section class="card">
        <header class="card-body p-0">
            <div class="tabpanel">
                <ul class="nav nav-tabs nav-tabs-right">
                    <li class="active" role="presentation">
                        <a href="#tab-1" data-toggle="tab" aria-expanded="true">@lang('order.index.inbox')</a>
                    </li>
                    <li class="presentation" role="presentation">
                        <a href="#tab-2" data-toggle="tab" aria-expanded="true">@lang('order.index.history')</a>
                    </li>
                </ul>
            </div>
        </header>

        <section class="tab-content  p-20">
            <section class="tab-pane fadeIn active" id="tab-1">
                <h2 class="card-title"> @lang('order.index.orders')</h2>
                <small class="dataTables_info"> @lang('order.index.short_title_inbox')</small>

                <div class="row">
                    <div class="card card-data-tables product-table-wrapper">
                        <div class="card-body p-0">
                            @if(isset($data['inbox']))
                                @include('client.order.fragments._table_select', ['data' => $data['inbox'],'table_id' => 'index-orders'])
                            @endif
                        </div>
                    </div>
                </div>
            </section>


            <section class="tab-pane fadeIn" id="tab-2">
                <h2 class="card-title"> @lang('order.index.history') </h2>
                <small class="dataTables_info">@lang('order.index.short_title_history')</small>

                <div class="row">
                    <div class="card card-data-tables product-table-wrapper">
                        <div class="card-body p-0">
                        </div>
                    </div>
                </div>
            </section>
        </section>
@endsection