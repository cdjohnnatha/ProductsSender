@extends('auth.register.register_template')

@section('content_register')
    <form action="{{ route('register.wizard') }}" method="POST" id="register_form" enctype="multipart/form-data">
        <div class="card-body p-0">
            <div class="form-wizard form-wizard-horizontal">
                <div class="tab-content clearfix p-30">
                    <section class="form-group">
                        {{ csrf_field() }}

                        <section class="row">
                            <div class="form-group is-empty">
                                <div class="input-group col-sm-8" data-placement="bottom" title="{{ __('auth.register.placeholder_identity') }}">
                                    <input type="file" class="form-control" placeholder="File Upload..."
                                           name="identification_card" accept="image/*">
                                    <div class="input-group">
                                        <label for="">@lang('auth.register.identity_document')</label>
                                        <input type="text" readonly="" class="form-control"
                                               placeholder="{{ __('auth.register.placeholder_input_identity') }}">
                                        <span class="input-group-btn input-group-sm">
                                              <button type="button" class="btn btn-info btn-fab btn-fab-sm">
                                                <i class="zmdi zmdi-attachment-alt"></i>
                                              </button>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="row">
                            <div class="form-group is-empty">
                                <div class="input-group  col-sm-8" data-placement="bottom" title="{{ __('auth.register.placeholder_proof_your_address') }}">
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


                    <input type="hidden" name="step" value="{{ $data['step'] }}">
                    <input type="hidden" name="client[name]" value="{{ $data['client']['name'] }}">
                    <input type="hidden" name="client[surname]" value="{{ $data['client']['surname'] }}">
                    <input type="hidden" name="client[identity_document]"
                           value="{{ $data['client']['identity_document'] }}">
                    <input type="hidden" name="client[tax_document]" value="{{ $data['client']['tax_document'] }}">
                    <input type="hidden" name="user[email]" value="{{ $data['user']['email'] }}">
                    <input type="hidden" name="user[password]" value="{{ $data['user']['password'] }}">
                    <input type="hidden" name="user[password_confirmation]"
                           value="{{ $data['user']['password_confirmation'] }}">

                    <input type="hidden" name="address[label]" value="{{ $data['address']['label'] }}">
                    <input type="hidden" name="address[owner_name]" value="{{ $data['address']['owner_name'] }}">
                    <input type="hidden" name="address[owner_surname]" value="{{ $data['address']['owner_surname'] }}">
                    <input type="hidden" name="address[phone]" value="{{ $data['address']['phone'] }}">
                    <input type="hidden" name="address[company_name]" value="{{ $data['address']['company_name'] }}">
                    <input type="hidden" name="address[number]" value="{{ $data['address']['number'] }}">
                    <input type="hidden" name="address[street2]" value="{{ $data['address']['street2'] }}">
                    <input type="hidden" name="address[postal_code]" value="{{ $data['address']['postal_code'] }}">
                    <input type="hidden" name="address[city]" value="{{ $data['address']['city'] }}">
                    <input type="hidden" name="address[state]" value="{{ $data['address']['state'] }}">
                    <input type="hidden" name="address[country]" value="{{ $data['address']['country'] }}">
                    <input type="hidden" name="address[street]" value="{{ $data['address']['street'] }}">
                    <input type="hidden" name="address[formatted_address]"
                           value="{{ $data['address']['formatted_address'] }}">

                    @foreach($data['phones'] as $key => $phone)
                        <input type="hidden" name="phones[{{ $key }}][number]" value="{{ $phone['number'] }}">
                    @endforeach
                </div>
            </div>
        </div>
        @include('layouts.formButtons.wizard._wizard_buttons', ['tagDisabled' => '', 'finish' => true])
        </div>
    </form>
@endsection

@section('footerJS')
    <script>
        $('#documents_flow').addClass('active');
        $('#address_flow').removeClass('active');
        $('#user_informations').removeClass('active');
    </script>
@endsection

