@extends('auth.register.register_template')

@section('content_register')
    <form action="{{ route('register.wizard') }}" method="post" id="address_form">
        <div class="card-body p-0">
            <div class="form-wizard form-wizard-horizontal">
                <div class="tab-content clearfix p-30">
                    <section class="form-group">
                        {{ csrf_field() }}
                            <section class="row">
                                <div class="form-group col-sm-4 label-floating {{ $errors->has('address.label') ? 'has-error' : '' }}">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
                                        <label class="control-label">@lang('auth.register.user_address')</label>
                                        <input type="text" class="form-control" name="address[label]"
                                               value="{{ $data['address']['label'] or old('address.label') }}" id="address.label">

                                        @if ($errors->has('address.label'))
                                            <span class="help-block">
                                                <strong class="text-danger" class="alert-danger">
                                                  {{ $errors->first('address.label') }}
                                                    <span class="zmdi zmdi-close form-control-feedback" aria-hidden="true"></span>
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-sm-4 label-floating {{ $errors->has('address.owner_name') ? 'has-error' : '' }} label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
                                        <label class="control-label">{{__('common.name')}}</label>
                                        <input type="text" class="form-control" name="address[owner_name]"
                                               value="{{ $data['address']['owner_name'] or old('address.owner_name') }}">
                                    </div>

                                    @if ($errors->has('address.owner_name'))
                                        <span class="help-block">
                                            <strong class="text-danger" class="alert-danger">
                                              {{ $errors->first('address.owner_name') }}
                                            </strong>
                                        </span>
                                        @endif
                                    </div>


                                    <div class="form-group col-sm-4 label-floating {{ $errors->has('address.owner_surname') ? ' has-error' : '' }} label-floating">
                                        <div class="input-group label-floating ">
                                            <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
                                            <label class="control-label">{{__('common.surname')}}</label>
                                            <input type="text" class="form-control" name="address[owner_surname]"
                                                   value="{{ $data['address']['owner_surname'] or old('address.owner_surname') }}">
                                        </div>
                                        @if ($errors->has('address.owner_surname'))
                                            <span class="help-block">
                                                <strong class="text-danger" class="alert-danger">
                                                  {{ $errors->first('address.owner_surname') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                            </section>

                            <section class="row">
                                <section class="form-group col-sm-4 label-floating {{ $errors->has('address.phone') ? ' has-error' : '' }} label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
                                        <label class="control-label">{{__('address.titles.phone')}}</label>
                                        <input type="number" class="form-control" name="address[phone]"
                                               value="{{ $data['address']['phone'] or old('address.phone') }}">

                                        @if ($errors->has('address.phone'))
                                            <span class="help-block">
                                                <strong class="text-danger" class="alert-danger">
                                                  {{ $errors->first('address.phone') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </section>

                                <section class="form-group col-sm-8 label-floating {{ $errors->has('address.company_name') ? ' has-error' : '' }} label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                        <label class="control-label">{{__('address.titles.company')}}</label>
                                        <input type="text" class="form-control" name="address[company_name]"
                                               value="{{ $data['address']['company_name'] or old('address.company_name') }}">

                                        @if ($errors->has('address.company_name'))
                                            <span class="help-block">
                                              <strong class="text-danger" class="alert-danger">
                                                {{ $errors->first('address.company_name') }}
                                              </strong>
                                            </span>
                                        @endif
                                    </div>
                                </section>
                            </section>



                            <section class="row">
                                <section class="form-group col-sm-2 label-floating {{ $errors->has('address.number') ? 'has-error' : '' }}">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
                                        <label class="control-label">@lang('address.titles.number')</label>
                                        <input type="text" class="form-control" name="address[number]" value="{{ $data['address']['number'] or old('address.number') }}">
                                    </div>
                                    @if ($errors->has('address.number'))
                                        <span class="help-block">
                                            <strong class="text-danger" class="alert-danger">
                                              {{ $errors->first('address.number') }}
                                            </strong>
                                        </span>
                                    @endif
                                </section>

                                <div class="form-group col-sm-5 label-floating
                                  {{
                                    $errors->has('address.formatted_address') ||
                                    $errors->has('geonames.country') ||
                                    $errors->has('geonames.city') ||
                                    $errors->has('geonames.state') ||
                                    $errors->has('address.city') ||
                                    $errors->has('address.state') ||
                                    $errors->has('address.country') ||
                                    $errors->has('address.street')  ? ' has-error' : '' }}">

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
                                        <label class="control-label">{{__('address.label.type_address')}}</label>
                                        <autocomplete-address set_address="{{ $data['address']['formatted_address'] or old('address.formatted_address')}}"></autocomplete-address>
                                        @if ($errors->has(['address.formatted_address', 'geonames.country']))
                                            <span class="help-block">
                                              <strong class="text-danger" class="alert-danger">
                                                {{ $errors->first('address.formatted_address') || __('statusMessage.errors.address_autocomplete') }}
                                              </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-sm-5 {{ $errors->has('address.street2') ? ' has-error' : '' }} label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
                                        <label class="control-label">{{__('address.titles.street2')}}</label>
                                        <input type="text" class="form-control" name="address[street2]"
                                               value="{{ $data['address']['street2'] or old('address.street2') }}">
                                    </div>

                                    @if ($errors->has('address.street2'))
                                        <span class="help-block">
                                          <strong class="text-danger" class="alert-danger">
                                            {{ $errors->first('address.street2') }}
                                          </strong>
                                        </span>
                                    @endif
                                </div>
                            </section>
                            <section class="row">
                                <div class="form-group col-sm-4 {{ $errors->has('address.postal_code') ? ' has-error' : '' }} label-floating">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
                                        <label class="control-label">{{__('address.titles.postal_code')}}</label>
                                        <input type="text" class="form-control" name="address[postal_code]"
                                               value="{{ $data['address']['postal_code'] or old('address.postal_code') }}">
                                    </div>

                                    @if ($errors->has('address.postal_code'))
                                        <span class="help-block">
                                          <strong class="text-danger" class="alert-danger">
                                            {{ $errors->first('address.postal_code') }}
                                          </strong>
                                        </span>
                                    @endif
                                </div>
                            </section>

                            <input type="hidden" id="city" name="address[city]" value="{{ $data['address']['city'] or old('address.city')}}">
                            <input type="hidden" id="state" name="address[state]" value="{{ $data['address']['state'] or old('address.state')}}">
                            <input type="hidden" id="country" name="address[country]" value="{{ $data['address']['country'] or old('address.country')}}">
                            <input type="hidden" id="street" name="address[street]" value="{{ $data['address']['street'] or old('address.street')}}">
                            <input type="hidden" id="formatted_address" name="address[formatted_address]" value="{{ $data['address']['formatted_address'] or old('address.formated_address')}}">

                            <input type="hidden" name="step" value="{{ $data['step'] }}">
                            <input type="hidden" name="client[name]" value="{{ $data['client']['name'] }}">
                            <input type="hidden" name="client[surname]" value="{{ $data['client']['surname'] }}">
                            <input type="hidden" name="client[identity_document]" value="{{ $data['client']['identity_document'] }}">
                            <input type="hidden" name="client[tax_document]" value="{{ $data['client']['tax_document'] }}">
                            <input type="hidden" name="user[email]" value="{{ $data['user']['email'] }}">
                            <input type="hidden" name="user[password]" value="{{ $data['user']['password'] }}">
                            <input type="hidden" name="user[password_confirmation]" value="{{ $data['user']['password_confirmation'] }}">
                            @foreach($data['phones'] as $key => $phone)
                                <input type="hidden" name="phones[{{ $key }}][number]" value="{{ $phone['number'] }}">
                            @endforeach
                    </section>
                </div>
            </div>
            @include('layouts.formButtons.wizard._wizard_buttons', ['tagDisabled' => '', 'finish' => false])
        </div>
    </form>
@endsection

@section('footerJS')
    <script>
        $('#address_flow').addClass('active');
        $('#informations_flow').removeClass('active');
    </script>
@endsection

