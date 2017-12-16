@extends('auth.register.register_template')

@section('content_register')
    <form action="{{ route('register.wizard') }}" method="POST" id="register_form">
        <div class="card-body p-0">
            <div class="form-wizard form-wizard-horizontal">
                <div class="tab-content clearfix p-30">
                    <div class="tab-pane active" id="tab1">
                        <section class="form-group">
                            {{ csrf_field() }}
                            @include('address._form', ['title' => __('user.registration.address_title')])

                            <input type="hidden" name="step" value="{{ $data['step'] }}">
                            <input type="hidden" name="client[name]" value="{{ $data['client']['name'] }}">
                            <input type="hidden" name="client[surname]" value="{{ $data['client']['surname'] }}">
                            <input type="hidden" name="client[identity_document]" value="{{ $data['client']['identity_document'] }}">
                            <input type="hidden" name="client[tax_document]" value="{{ $data['client']['tax_document'] }}">
                            <input type="hidden" name="user[email]" value="{{ $data['user']['email'] }}">
                            <input type="hidden" name="user[password]" value="{{ $data['user']['email'] }}">
                            <input type="hidden" name="user[password_confirmation]" value="{{ $data['user']['email'] }}">
                            @foreach($data['phones'] as $key => $phone)
                                <input type="hidden" name="phones[{{ $key }}][number]" value="{{ $phone['number'] }}">
                            @endforeach
                        </section>
                    </div>
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

