@extends('layouts.app')

@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
@if(!auth()->guard('admin')->user())
  @include('subscription.index_user')
@endif

<form action="{{ route('register') }}" method="POST" id="register_form">

<div id="registration_content" class="container {{auth()->guard('admin')->user() ? '' : 'hidden'}}">
  <div class="content-body">
    <div class="row">
      <div class="col-lg-10">
        <div class="card" id="rootwizard">
          <div class="card-heading">
            <form class="form floating-label">
              <div class="form-wizard-nav">
                <div class="progress" style="width: 75%;">
                  <div class="progress-bar" style="width:0;"></div>
                </div>
                <ul class="nav nav-justified nav-pills">
                  <li class="active">
                    <a href="#tab1" data-toggle="tab" aria-expanded="true">
                      <span class="step">1</span>
                      <span class="title">{{__('user.registration.form_info_title')}}</span>
                    </a>
                  </li>
                  <li class="">
                    <a href="#tab2" data-toggle="tab" aria-expanded="false"><span class="step">2</span>
                      <span class="title">Address</span>
                    </a>
                  </li>
                  <li class="">
                    <a href="#tab3" data-toggle="tab" aria-expanded="false"><span class="step">3</span>
                      <span class="title">Payment</span>
                    </a>
                  </li>
                </ul>
              </div>
          </div>


            <div class="card-body p-0">
                 {{ csrf_field() }}
              <input type="hidden" name="user[subscription_id]" id="subscription_id">
              <div class="form-wizard form-wizard-horizontal">
                <div class="tab-content clearfix p-30">
                  <div class="tab-pane active" id="tab1">
                    <section class="form-group">
                      @include('user._form')
                    </section>
                  </div>
                  <!--end User Informations #tab1 -->
                  <div class="tab-pane" id="tab2">
                      @include('address._form', ['title' => __('user.registration.address_title')])
                  </div>
                  <!--end Address informations #tab2 -->

                  <!--end Plans #tab3 -->

                  <div class="tab-pane" id="tab3">
                    {{--<form class="form-horizontal" role="form" >--}}
                      <div class="row">
                        <div class="col-xs-6">
                          <div class="form-group label-floating is-empty">
                            <label class="control-label">First Name on Card</label>
                            <input type="text" class="form-control" name="card-holder-name" id="card-holder-name">
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="form-group label-floating is-empty">
                            <label class="control-label">Last Name on Card</label>
                            <input type="text" class="form-control" name="card-holder-name" id="card-holder-name">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6">
                          <div class="form-group label-floating is-empty">
                            <label class="control-label">Credit Card Number</label>
                            <input type="text" class="form-control" name="card-holder-name" id="card-holder-name">
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <h4>We Accept:</h4>
                          <ul class="style-none list-inline">
                            <li><img src="{{asset('/img/icons/cc/visa.png')}}" alt="" /></li>
                            <li><img src="{{asset('img/icons/cc/mastercard.png')}}" alt="" /></li>
                            <li><img src="{{asset('img/icons/cc/discover.png')}}" alt="" /></li>
                            <li><img src="{{asset('img/icons/cc/american-express.png')}}" alt="" /></li>
                          </ul>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-4">
                          <div class="form-group label-floating is-empty">
                            <label class="control-label">CVC Number</label>
                            <input type="text" class="form-control" name="card-holder-name" id="card-holder-name">
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="row">
                            <div class="col-xs-6">
                              <div class="form-group">
                                <select class="form-control select" name="expiry-month" id="expiry-month">
                                  <option>Month</option>
                                  <option value="01">Jan (01)</option>
                                  <option value="02">Feb (02)</option>
                                  <option value="03">Mar (03)</option>
                                  <option value="04">Apr (04)</option>
                                  <option value="05">May (05)</option>
                                  <option value="06">June (06)</option>
                                  <option value="07">July (07)</option>
                                  <option value="08">Aug (08)</option>
                                  <option value="09">Sep (09)</option>
                                  <option value="10">Oct (10)</option>
                                  <option value="11">Nov (11)</option>
                                  <option value="12">Dec (12)</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-xs-6">
                              <div class="form-group">
                                <select class="form-control select" name="expiry-year">
                                  <option value="13">2013</option>
                                  <option value="14">2014</option>
                                  <option value="15">2015</option>
                                  <option value="16">2016</option>
                                  <option value="17">2017</option>
                                  <option value="18">2018</option>
                                  <option value="19">2019</option>
                                  <option value="20">2020</option>
                                  <option value="21">2021</option>
                                  <option value="22">2022</option>
                                  <option value="23">2023</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    {{--</form>--}}
                  </div>
                </div>
              </div>

            </div>
            <div class="card-footer">
              <ul class="pager wizard">
                <li class="previous disabled"><a class="btn btn-primary btn-round" href="javascript:void(0);">Previous</a></li>
                <li class="next"><a class="btn btn-primary btn-round" href="javascript:void(0);" id="next_btn">Next</a></li>
                <li class="finish">
                  <button type="submit" class="btn btn-green btn-round pull-right" id="submit-button">Register</button>
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
