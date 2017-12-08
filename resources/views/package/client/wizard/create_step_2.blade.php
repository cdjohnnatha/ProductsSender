@extends('layouts.app')

@section('panel_header')
  Incoming Packages
@endsection

@section('content')

  @if(Request::is('*/edit'))
    <form action="{{ route('user.packages.update', $incoming->id) }}" role="form" method="POST">
      <input name="_method" type="hidden" value="PUT">
      @else
        <form action="{{ route('user.packages.store') }}" role="form" method="POST" id="form_package_incoming">
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
                          <li class=""><a href="#tab1" data-toggle="tab" aria-expanded="true">
                            <span class="step">
                              <i class="zmdi zmdi-notifications-add"></i>
                            </span>
                              <span class="title">
                              {{ __('packages.user.incoming_form') }}
                            </span>
                            </a>
                          </li>
                          <li class="active" disabled>
                            <a href="#tab2" data-toggle="tab" aria-expanded="false" disabled>
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
                            @include('addons._checkbox')
                          </section>
                          <input type="hidden" name="step" value="{{ $steps }}">
                          <input type="hidden" name="package[provider]" value="{{ $package['package']['provider'] }}">
                          <input type="hidden" name="package[addressee]" value="{{ $package['package']['addressee'] }}">
                          <input type="hidden" name="package[company_warehouse_id]" value="{{ $package['package']['company_warehouse_id'] }}">
                          <input type="hidden" name="package[track_number]" value="{{ $package['package']['track_number'] }}">
                          <input type="hidden" name="package[content_type]" value="{{ $package['package']['content_type'] }}">
                          <input type="hidden" name="package[description]" value="{{ $package['package']['description'] }}">
                          <input type="hidden" name="custom_clearance" value="{{ json_encode($package['custom_clearance']) }}">
                        </div>
                      </div>
                    </section>
                    <div class="card-footer">
                      <ul class="pager wizard">
                        <li class="previous"><button id="previous_button" name='button' class="btn btn-primary btn-round pull-left" type="button">{{ __('buttons.titles.previous') }}</button></li>
                        <li class="next"><button type="submit" id="submit-button" class="btn btn-success btn-round pull-right">{{__('buttons.titles.confirm')}}</button></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
@endsection

@section('footerJS')

  <script>
      $('#previous_button').click(function(){
          alert('test');
          var form = $('#form_package_incoming');
          form.attr('action', '/user/packages/wizard');
          form.submit();
      });
  </script>
@endsection