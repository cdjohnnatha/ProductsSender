@extends('layouts.app')

@section('panel_header')
  {{__('address.titles.form')}}
@endsection

@section('content')
  <section class="content-body">
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          @if(Request::is('*/edit'))
            <form action="{{ route('user.payment_transactions.update', $address->id )}}" role="form" method="POST">
              <input name="_method" type="hidden" value="PUT">
          @else
              <form action="{{ route('user.payment_transactions.store') }}" role="form" method="POST" class="form-horizontal">
          @endif
            {{ csrf_field() }}
            <section class="card-body">
                <header class="card-heading ">
                    <h2 class="card-title">Payments</h2>
                </header>
                    <div class="form-group is-empty">
                        <label for="featuresItems" class="col-md-2 control-label">@lang('invoice.create.payment_options')</label>
                        <div class="col-md-10 {{ $errors->has('payment_type') ? ' has-error' : '' }}">
                            <select class="select form-control" name="payment_type">
                                <option value="deposit">Bank Deposit</option>
                                <option value="bitcoin">Bitcoin</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="paypal">Paypal</option>
                            </select>
                            @if ($errors->has('payment_type'))
                                <span class="help-block">
                                    <strong class="text-danger" class="alert-danger">
                                      {{ $errors->first('payment_type') }}
                                    </strong>
                                  </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group is-empty">
                        <label for="productSku" class="col-md-2 control-label">@lang('invoice.index.amount')</label>
                        <div class="col-md-10 {{ $errors->has('amount') ? ' has-error' : '' }}">
                            <input type="number" class="form-control" min="0.01" step="0.01" name="amount">
                            <input type="hidden" name="client_id" value="{{ Auth::user()->client->id }}">
                            @if ($errors->has('amount'))
                                <span class="help-block">
                                    <strong class="text-danger" class="alert-danger">
                                      {{ $errors->first('amount') }}
                                    </strong>
                                  </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <div class="col-md-12">
                            <a href="{{ route('user.invoices.index') }}" class="btn btn-primary btn-flat ">Cancel</a>
                            <button class="btn btn-primary">Create Payment</button>
                        </div>
                    </div>
            </section>
            <footer class="card-footer text-right">
              {{--@include('layouts.formButtons._form_save_edit', ['url' => route('user.address.index')])--}}
            </footer>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection






