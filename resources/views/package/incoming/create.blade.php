@extends('layouts.app')

@section('panel_header')
  Incoming Packages
@endsection

@section('content')

  <div id="content" class="container">
    <div class="content-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card" id="rootwizard">
            <div class="card-heading">
              <form class="form floating-label">
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
                          {{__('packages.incoming.form.title_form')}}
                        </span>
                      </a>
                    </li>
                    <li class="">
                      <a href="#tab2" data-toggle="tab" aria-expanded="false">
                        <span class="step"><i class="zmdi zmdi-assignment"></i></span>
                        <span class="title">{{__('packages.incoming.form.goods_custom_clearance')}}</span>
                      </a>
                    </li>
                    <li class="">
                      <a href="#tab3" data-toggle="tab" aria-expanded="false">
                        <span class="step"><i class="zmdi zmdi-shopping-cart"></i></span>
                        <span class="title">{{__('packages.incoming.form.services')}}</span>
                      </a>
                    </li>
                    <li class=""><a href="#tab4" data-toggle="tab" aria-expanded="false"><span class="step">4</span> <span class="title">Confirmation</span></a></li>
                  </ul>
                </div>
            </div>
            @if(Request::is('*/edit'))
              <?php $action = 'user.incoming.update' ?>
              <form action="{{route($action, $incoming->id)}}" role="form" method="POST">
              <input name="_method" type="hidden" value="PUT">
            @else
              <?php $action = 'user.incoming.store' ?>
              <form action="{{route($action)}}" role="form" method="POST">
            @endif
                {{ csrf_field() }}
                <section class="card-body p-0">
                  <div class="form-wizard form-wizard-horizontal">
                    <div class="tab-content clearfix p-30">
                      <section class="tab-pane active" id="tab1">
                        @include('package.incoming._form')
                      </section>
                      <!--end #tab1 -->
                      <section class="tab-pane" id="tab2">
                        <custom-clearance-form></custom-clearance-form>
                      </section>
                      <!--end #tab2 -->
                      <section class="tab-pane" id="tab3">
                        <h2>
                          <i class="zmdi zmdi-shopping-cart"></i>
                          Services
                        </h2>
                        @include('services._checkbox')
                      </section>
                      <!--end #tab3 -->
                      <section class="tab-pane" id="tab4">


                      </section>
                    </div>
                  </div>
                </section>
                <div class="card-footer">
                  <ul class="pager wizard">
                    <li class="previous disabled"><a class="btn btn-primary btn-round" href="javascript:void(0);">Previous</a></li>
                    <li class="next"><a class="btn btn-primary btn-round" href="javascript:void(0);">Next</a></li>
                    <li class="finish"><button class="btn btn-green btn-round pull-right">Place Order</button></li>
                  </ul>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
