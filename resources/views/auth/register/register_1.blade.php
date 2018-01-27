@extends('auth.register.register_template')

@section('content_register')
    <form action="{{ route('register.wizard') }}" method="POST" id="register_form">
        <div class="card-body p-0">
            <div class="form-wizard form-wizard-horizontal">
                <div class="tab-content clearfix p-30">
                    <section class="form-group">
                        {{ csrf_field() }}
                        <input type="hidden" name="step" value="1">

                        <input type="hidden" id="label" name="address[label]" value="{{ $data['address']['label'] or old('address.label')}}">
                        <input type="hidden" id="owner_name" name="address[owner_name]" value="{{ $data['address']['owner_name'] or old('address.owner_name')}}">
                        <input type="hidden" id="owner_surname" name="address[owner_surname]" value="{{ $data['address']['owner_surname'] or old('address.owner_surname')}}">
                        <input type="hidden" id="phone" name="address[phone]" value="{{ $data['address']['phone'] or old('address.phone')}}">
                        <input type="hidden" id="company_name" name="address[company_name]" value="{{ $data['address']['company_name'] or old('address.company_name')}}">
                        <input type="hidden" id="number" name="address[number]" value="{{ $data['address']['number'] or old('address.number')}}">
                        <input type="hidden" id="street2" name="address[street2]" value="{{ $data['address']['street2'] or old('address.street2')}}">
                        <input type="hidden" id="postal_code" name="address[postal_code]" value="{{ $data['address']['postal_code'] or old('address.postal_code')}}">

                        <input type="hidden" id="city" name="address[city]" value="{{ $data['address']['city'] or old('address.city')}}">
                        <input type="hidden" id="state" name="address[state]" value="{{ $data['address']['state'] or old('address.state')}}">
                        <input type="hidden" id="country" name="address[country]" value="{{ $data['address']['country'] or old('address.country')}}">
                        <input type="hidden" id="street" name="address[street]" value="{{ $data['address']['street'] or old('address.street')}}">
                        <input type="hidden" id="formatted_address" name="address[formatted_address]" value="{{ $data['address']['formatted_address'] or old('address.formated_address')}}">

                        <article>
                            <section class="row">
                                <div class="form-group col-sm-6 label-floating {{ $errors->has('client.name') ? ' has-error' : '' }}">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                        <label class="control-label">@lang('auth.register.name')</label>
                                        <input type="text" class="form-control" name="client[name]"
                                               value="{{ $data['client']['name'] or old('client.name') }}">

                                        @if ($errors->has('client.name'))
                                            <span class="help-block">
                                                    <strong class="text-danger" class="alert-danger">
                                                      {{ $errors->first('client.name') }}
                                                    </strong>
                                                  </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 {{ $errors->has('client.surname') ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">@lang('auth.register.surname')</label>
                                    <input type="text" class="form-control" name="client[surname]"
                                           value="{{ $data['client']['surname'] or old('client.surname') }}">

                                    @if ($errors->has('client.surname'))
                                        <span class="help-block">
                                              <strong class="text-danger" class="alert-danger">
                                                {{ $errors->first('client.surname') }}
                                              </strong>
                                            </span>
                                    @endif
                                </div>

                            </section>

                            <section class="row">
                                <div class="form-group col-sm-6 label-floating {{ $errors->has('client.identity_document') ? ' has-error' : '' }}">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
                                        <label class="control-label"
                                               for="identity_document">@lang('auth.register.identity_document')</label>
                                        <input type="text" class="form-control" name="client[identity_document]"
                                               value="{{ $data['client']['identity_document'] or old('client.identity_document') }}"
                                               id="identity_document">

                                        @if ($errors->has('client.identity_document'))
                                            <span class="help-block">
                                                    <strong class="text-danger" class="alert-danger">
                                                      {{ $errors->first('client.identity_document') }}
                                                    </strong>
                                                  </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 label-floating {{ $errors->has('client.tax_document') ? ' has-error' : '' }}">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
                                        <label class="control-label">@lang('auth.register.tax_document')</label>
                                        <input type="text" class="form-control" name="client[tax_document]"
                                               value="{{ $data['client']['tax_document'] or old('client.tax_document') }}">

                                        @if ($errors->has('client.tax_document'))
                                            <span class="help-block">
                                                    <strong class="text-danger" class="alert-danger">
                                                      {{ $errors->first('client.tax_document') }}
                                                    </strong>
                                                  </span>
                                        @endif
                                    </div>
                                </div>

                            </section>

                            <section class="row">
                                <div class="col-sm-12">
                                    <phones-component
                                            :editing="{{ isset($data['phones']) ? json_encode($data['phones']) : json_encode(old('phones')) }}"></phones-component>
                                </div>
                            </section>

                            <section class="row">
                                <section
                                        class="form-group col-sm-12 {{ ($errors->has('user.email') || isset($data['emailValidation']) ) ? ' has-error' : '' }} label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                                        <label class="control-label">@lang('auth.register.email')</label>
                                        <input type="email" class="form-control" name="user[email]"
                                               value="{{ $data['user']['email'] or old('user.email') }}">

                                        @if ($errors->has('user.email') || isset($data['emailValidation']))
                                            <span class="help-block">
                                                  <strong class="text-danger" class="alert-danger">
                                                    {{ $errors->first('user.email') }}
                                                      @if(isset($data['emailValidation']))
                                                        {{ $data['emailValidation'] }}
                                                      @endif
                                                  </strong>
                                                </span>
                                        @endif
                                    </div>
                                </section>

                            </section>

                            <section class="row">
                                <div class="form-group col-sm-6  label-floating {{ $errors->has('user.password') ? 'has-error' : '' }}">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
                                        <label class="control-label">@lang('auth.register.password')</label>
                                        <input type="password" class="form-control" name="user[password]"
                                               value="{{ old('user.password') }}">


                                        @if ($errors->has('user.password'))
                                            <span class="help-block">
                                                    <strong class="text-danger" class="alert-danger">
                                                      {{ $errors->first('user.password') }}
                                                    </strong>
                                                  </span>
                                            <span class="zmdi zmdi-close form-control-feedback"></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-sm-6 {{ $errors->has('user.password_confirmation') ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">@lang('auth.register.password_confirm')</label>
                                    <input type="password" class="form-control" name="user[password_confirmation]">
                                </div>
                            </section>
                        </article>
                    </section>
                </div>
            </div>
            @include('layouts.formButtons.wizard._wizard_buttons', ['tagDisabled' => 'disabled', 'finish' => false])
        </div>
    </form>
@endsection



