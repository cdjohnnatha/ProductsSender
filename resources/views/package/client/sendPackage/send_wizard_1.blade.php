@extends('layouts.app')

@section('panel_header')
    @lang('singlePackage.titles.main_title')
@endsection

@section('content')

    @if(Request::is('*/edit'))
        <form action=" {{ route('user.packages.processPackageWizard') }}" role="form" method="POST">
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
                                        <li class="active">
                                            <a href="#tab1" data-toggle="tab" aria-expanded="true">
                                            <span class="step"><i class="zmdi zmdi-assignment"></i> </span>
                                            <span class="title">@lang('singlePackage.titles.title_step_1') </span>
                                            </a>
                                        </li>
                                        <li>
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

                            <section class="card-body p-0">
                                <div class="form-wizard form-wizard-horizontal">
                                    <div class="tab-content clearfix p-30">
                                        <section class="tab-pane active" id="tab1">
                                            @foreach($packages as $package)
                                                @include('package.fragments._informations')
                                            @endforeach
                                        </section>
                                    </div>
                                </div>
                            </section>
                            <footer class="card-footer">
                                <ul class="pager wizard">
                                    <li class="previous disabled">
                                        <button type="submit" name="previous" class="btn btn-primary btn-round pull-left" disabled>
                                            @lang('buttons.titles.previous')
                                        </button>
                                    </li>
                                    <li class="next"><button type="submit" name="next" value="true" class="btn btn-primary btn-round pull-right"
                                                        id="next_button"> @lang('buttons.titles.next') </button>
                                    </li>
                                </ul>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
@endsection