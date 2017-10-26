@extends('layouts.app')

@section('panel_header')
  {{__('singlePackage.titles.main_title')}}
@endsection

@section('content')
    <?php

      if(auth()->guard('web')->user()){
          $action = 'user';
      } else {
          $action = 'admin';
      }

      $action .= '.incoming.';
    ?>

    @if(Request::is('*/edit'))
        <?php $action .= 'update'?>
        <form action="{{route($action, $incoming->id)}}" role="form" method="POST">
          <input name="_method" type="hidden" value="PUT">
    @else
      <?php $action .= 'store' ?>
      <form action="{{route($action)}}" role="form" method="POST">
    @endif
      {{ csrf_field() }}
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
                      <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">
                    <span class="step">
                      <i class="zmdi zmdi-assignment"></i>
                    </span>
                    <span class="title">
                      {{__('singlePackage.titles.title_step_1')}}
                    </span>
                        </a>
                      </li>
                      <li class="">
                        <a href="#tab2" data-toggle="tab" aria-expanded="false">
                          <span class="step"><i class="zmdi zmdi-shopping-cart"></i></span>
                          <span class="title">{{__('addon')}}</span>
                        </a>
                      </li>

                      <li class="">
                        <a href="#tab3" data-toggle="tab" aria-expanded="false">
                          <span class="step"><i class="zmdi zmdi-truck"></i></span>
                          <span class="title">{{__('common.titles.shipment_method')}}</span>
                        </a>
                      </li>
                      <li class="">
                        <a href="#tab4" data-toggle="tab" aria-expanded="false">
                          <span class="step"><i class="zmdi zmdi-card"></i></span>
                          <span class="title">{{__('common.titles.payment_method')}}</span>
                        </a>
                      </li>
                      <li class="">
                        <a href="#tab5" data-toggle="tab" aria-expanded="false">
                          <span class="step"><i class="zmdi zmdi-check"></i></span>
                          <span class="title">{{__('common.titles.confirmation')}}</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

                <section class="card-body p-0">
                  <div class="form-wizard form-wizard-horizontal">
                    <div class="tab-content clearfix p-30">
                      <section class="tab-pane active" id="tab1">
                        @include('package.fragments._informations')
                        @if($package->goods)
                            @include('package.incoming._show', ['incomingPackage' => $package->goods])
                            <input type="hidden" value="{{$package->id}}" id="package_id" name="package_id">
                        @endif
                      </section>
                      <!--end #tab1 -->

                      <!--end #tab2 -->
                      <section class="tab-pane" id="tab2">
                        <h2>
                          <i class="zmdi zmdi-shopping-cart"></i>
                          Services
                        </h2>
                        @if(auth()->guard('web')->user() && Auth::user()->subscription->amount > 0)
                          <small style="color: #ff5722;">{{__('packages.incoming.form.small_marketing_services',
                              ['discount'=> Auth::user()->subscription->discounts])}}</small>
                        @endif
                        @include('service._checkbox', ['reservation' => $package->goods])

                      </section>

                      <section class="tab-pane" id="tab3">
                        <h2>
                          <i class="zmdi zmdi-my-location"></i>
                          Address
                          <div class="card-body p-50 p-t-10 invoice">
                            <div class="row">
                              <div class="col-xs-6">
                                <h3>{{__('packages.index.address_from')}}</h3>
                                <address class="address">
                                  {{$package->warehouse->address['label']}}<br>
                                  {{$package->warehouse->address['number'] . ', ' . $package->warehouse->address['formatted_address']}}<br>
                                  {{$package->warehouse->address['phone']}}<br>
                                  <input type="hidden" id="address_id" name="address_id" value="{{Auth::user()->defaultAddress['id']}}">
                                </address>
                              </div>
                              <div class="col-xs-6">
                                <h3>{{__('packages.index.address_to')}}</h3>
                                <address class="address">
                                  <span id="address_to_label">{{Auth::user()->defaultAddress['label']}}</span><br>
                                  <span id="address_to_address">{{Auth::user()->defaultAddress['number'] . ', '. Auth::user()->defaultAddress['formatted_address']}}</span><br>
                                  <span id="address_to_phone">{{Auth::user()->defaultAddress['phone']}}</span><br>
                                  <a href="javascript:void(0);" id="change_address_action" data-toggle="modal" data-target="#basic_modal">change</a>
                                </address>
                              </div>
                            </div>
                        </h2>
                        <shipment-component :addresses="{{Auth::user()->address}}"></shipment-component>
                      </section>

                      <section class="tab-pane" id="tab5">
                        @include('utils._payments')
                      </section>

                    </div>
                  </div>
                </section>
                <div class="card-footer">
                  <ul class="pager wizard">
                    <li class="previous disabled"><a class="btn btn-primary btn-round" href="javascript:void(0);">{{__('buttons.titles.previous')}}</a></li>
                    <li class="next"><a class="btn btn-primary btn-round" href="javascript:void(0);" id="next_button">{{__('buttons.titles.next')}}</a></li>
                    <li class="finish">
                      <button type="submit" id="submit-button" class="btn btn-green btn-round pull-right">{{__('buttons.titles.confirm')}}</button>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    @include('package.fragments._photoswipe_element')
@endsection

@section('footerJS')
  @parent

@endsection


