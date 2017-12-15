@extends('layouts.app')

@section('panel_header')
    @lang('singlePackage.titles.main_title')
@endsection

@section('content')

    @if(Request::is('*/edit'))
        <form action="" role="form" method="POST">
            <input name="_method" type="hidden" value="PUT">
    @else
        <form action="" role="form" method="POST">
    @endif
        {{ csrf_field() }}
            <input type="hidden" name="step" value="{{ $steps }}">

            <div id="content" class="container">
            <div class="content-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="rootwizard">
                            <div class="card-heading">
                                <div class="form-wizard-nav">
                                    <div class="progress" style="width: 75%;">
                                        <div class="progress-bar" style="width:0%;"></div>
                                    </div>
                                    <ul class="nav nav-justified nav-pills">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" aria-expanded="true">
                                            <span class="step"><i class="zmdi zmdi-assignment"></i> </span>
                                            <span class="title">@lang('singlePackage.titles.title_step_1') </span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false">
                                                <span class="step"><i class="zmdi zmdi-shopping-cart"></i></span>
                                                <span class="title">@lang('addon') </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false">
                                                <span class="step"><i class="zmdi zmdi-truck"></i></span>
                                                <span class="title"> @lang('common.titles.shipment_method') </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false">
                                                <span class="step"><i class="zmdi zmdi-card"></i></span>
                                                <span class="title"> @lang('common.titles.payment_method') </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false">
                                                <span class="step"><i class="zmdi zmdi-check"></i></span>
                                                <span class="title"> @lang('common.titles.confirmation') </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <section class="p-0">
                                <div class="form-wizard form-wizard-horizontal">
                                    <div class="tab-content clearfix p-30">
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-default">
                                                @foreach($packages as $key => $package)
                                                    <input type="hidden" name="packages_id[]" value="{{ $package }}">

                                                    @include('package.fragments._collapsible_package_addons',
                                                    [
                                                        'index' => $key + 1,
                                                        'packageId' => $package
                                                    ]
                                                    )
                                                @endforeach
                                                    <input type="hidden" name="total_addons" id="total_service_input" value="0.00">
                                                    <div class="row">
                                                    <div class="col-xs-6 col-sm-11 text-right ">
                                                        <span class="block p-b-5 md-text-grey">{{ __('payments.titles.sub_total') }}:</span>
                                                        <span class="block p-b-5 md-text-grey">{{ __('payments.titles.discount') }}:</span>
                                                        <span class="block p-b-5 p-t-5">{{ __('payments.titles.total') }}:</span>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-1 p-0">
                                                        <span class="block p-b-5" id="services_first_value">0.00</span>
                                                        <span class="block p-b-5" id="discount_services">0.00</span>
                                                        <span class="block p-b-5 cart-total" id="total_services">0.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <footer class="card-footer">
                                <ul class="pager wizard">
                                    <li class="previous disabled">
                                        <button type="submit" name="previous" value="true" class="btn btn-primary btn-round pull-left">
                                            @lang('buttons.titles.previous')
                                        </button>
                                    </li>
                                    <li class="next"><button type="submit" name="next" value="true" class="btn btn-primary btn-round pull-right"
                                                             id="next_button"> @lang('buttons.titles.next') </button>
                                    </li>
                                    {{--<li class="finish">--}}
                                        {{--<button type="submit" id="submit-button" class="btn btn-green btn-round pull-right">--}}
                                            {{--@lang('buttons.titles.confirm')--}}
                                        {{--</button>--}}
                                    {{--</li>--}}
                                </ul>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
@endsection