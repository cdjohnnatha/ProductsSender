@extends('layouts.app')

@section('panel_header')
  Incoming Packages
@endsection

@section('content')

  @if(Request::is('*/edit'))
    <form action="{{ route('user.packages.update', $incoming->id) }}" role="form" method="POST">
      <input name="_method" type="hidden" value="PUT">
  @else
    <form action="{{ route('user.packages.store') }}" role="form" method="POST">
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
                              <i class="zmdi zmdi-notifications-add"></i>
                            </span>
                            <span class="title">
                              {{ __('packages.user.incoming_form') }}
                            </span>
                          </a>
                        </li>
                        <li class="">
                          <a href="#tab2" data-toggle="tab" aria-expanded="false">
                            <span class="step"><i class="zmdi zmdi-assignment"></i></span>
                            <span class="title">{{ __('packages.user.declare_goods') }}</span>
                          </a>
                        </li>
                        <li class="">
                          <a href="#tab3" data-toggle="tab" aria-expanded="false">
                            <span class="step"><i class="zmdi zmdi-shopping-cart"></i></span>
                            <span class="title">{{ __('addon') }}</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                </div>

                <section class="card-body p-0">
                  <div class="form-wizard form-wizard-horizontal">
                    <div class="tab-content clearfix p-30">
                      <section class="tab-pane active" id="tab1">
                        @include('package.client._form')
                      </section>
                      <!--end #tab1 -->
                      <section class="tab-pane" id="tab2">
                        @if(Request::is('*/edit'))
                          <custom-clearance-form :editing="{{ $incoming->goodsDeclaration()->get() }}"></custom-clearance-form>
                        @else
                          <custom-clearance-form></custom-clearance-form>
                        @endif
                      </section>
                      <!--end #tab2 -->
                      <section class="tab-pane" id="tab3">
                        <h2>
                          <i class="zmdi zmdi-shopping-cart"></i>
                          Services
                        </h2>
                        @include('service._checkbox')
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
@endsection
