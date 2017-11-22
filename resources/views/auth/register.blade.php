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

  <form action="{{ route('register') }}" method="POST" id="register_form" enctype="multipart/form-data">
    <div id="registration_content" class="container">
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
                          <span class="title">Documents</span>
                        </a>
                      </li>
                    </ul>
                  </div>
              </div>

              <div class="card-body p-0">
                {{ csrf_field() }}
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


                    <section class="tab-pane" id="tab3">
                      <section class="row">
                        <section class="col-sm-6">
                          <div class="form-group is-empty">
                            <div class="input-group">
                              <input type="file" class="form-control" placeholder="File Upload..."
                                     name="identification_card" accept="image/*">
                              <div class="input-group">
                                <label for="">Documentation</label>
                                <input type="text" readonly="" class="form-control"
                                       placeholder="Upload of identification card (both sides)">
                                <span class="input-group-btn input-group-sm">
                              <button type="button" class="btn btn-info btn-fab btn-fab-sm">
                                <i class="zmdi zmdi-attachment-alt"></i>
                              </button>
                            </span>
                              </div>
                            </div>
                          </div>
                        </section>

                        <section class="col-sm-6">
                          <div class="form-group is-empty">
                            <div class="input-group">
                              <input type="file" class="form-control" placeholder="Form of USPS" name="usps_form"
                                     accept="image/*">
                              <div class="input-group">
                                <label for="">Signed USPS 1583 Form</label>
                                <input type="text" readonly="" class="form-control"
                                       placeholder="Upload a picture of USPS 1583 form">
                                <span class="input-group-btn input-group-sm">
                              <button type="button" class="btn btn-info btn-fab btn-fab-sm">
                                <i class="zmdi zmdi-attachment-alt"></i>
                              </button>
                            </span>
                              </div>
                            </div>
                          </div>
                        </section>
                      </section>

                      <section class="row">
                        <section class="col-sm-12">
                          <div class="form-group is-empty">
                            <div class="input-group">
                              <input type="file" class="form-control" placeholder="File Upload..." name="proof_address"
                                     accept="application/pdf, image/*">
                              <div class="input-group">
                                <label for="">Proof of Address</label>
                                <input type="text" readonly="" class="form-control"
                                       placeholder="Upload proof of address">
                                <span class="input-group-btn input-group-sm">
                              <button type="button" class="btn btn-info btn-fab btn-fab-sm">
                                <i class="zmdi zmdi-attachment-alt"></i>
                              </button>
                            </span>
                              </div>
                            </div>
                          </div>
                        </section>
                      </section>
                    </section>
                  </div>

                </div>
                <div class="card-footer">
                  <ul class="pager wizard">
                    <li class="previous disabled"><a class="btn btn-primary btn-round"
                                                     href="javascript:void(0);">Previous</a></li>
                    <li class="next"><a class="btn btn-primary btn-round" href="javascript:void(0);"
                                        id="next_btn">Next</a></li>
                    <li class="finish">
                      <button type="submit" class="btn btn-green btn-round pull-right" id="submit-button">Register
                      </button>
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
