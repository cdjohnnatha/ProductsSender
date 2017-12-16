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

    <div id="registration_content" class="container">
        <div class="content-body">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card" id="rootwizard">
                        <div class="card-heading">
                            <div class="form-wizard-nav">
                                <div class="progress" style="width: 75%;">
                                    <div class="progress-bar" style="width:0;"></div>
                                </div>
                                <ul class="nav nav-justified nav-pills">
                                    <li class="active" id="informations_flow">
                                        <a href="javascript:void(0);" data-toggle="tab" aria-expanded="true">
                                            <span class="step">1</span>
                                            <span class="title">@lang('auth.register.user_informations')</span>
                                        </a>
                                    </li>
                                    <li class="" id="address_flow">
                                        <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false">
                                            <span class="step">2</span>
                                            <span class="title">@lang('auth.register.user_address')</span>
                                        </a>
                                    </li>
                                    <li class="" >
                                        <a href="javascript:void(0);" data-toggle="tab" aria-expanded="false" disabled><span
                                                    class="step">3</span>
                                            <span class="title">@lang('auth.register.user_documents')</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @yield('content_register')

                    </div>
                </div>
            </div>
        </div>
@endsection