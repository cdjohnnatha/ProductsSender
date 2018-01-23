@extends('layouts.app')


@section('panel_header')
  @lang('user.address.client_addresses')
@endsection

@section('content')
  <section class="card">
    <header class="card-body p-0">
      <div class="tabpanel">
        <ul class="nav nav-tabs nav-tabs-right">
          <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab" aria-expanded="true">{{__('address.label.box_address')}}</a></li>
          <li role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">{{__('address.label.mailing_address')}}</a></li>
        </ul>
      </div>
    </header>

    <section class="tab-content  p-20">
      <section class="tab-pane fadeIn active" id="tab-1">

        <header class="card-heading">
          <h2 class="card-title">@lang('user.address.addresses')</h2>
          <small class="dataTables_info">@lang('address.label.short_description')</small>
          <ul class="card-actions icons fab-action right-bottom">
            <li>
              <button class="btn btn-primary btn-fab btn-fab-sm animate-fab" onclick="window.location='{{ Route('user.addresses.create') }}'">
                <i class="zmdi zmdi-plus"></i>
              </button>
            </li>
          </ul>
        </header>

        <div class="row">
          <div class="card-body p-0">
            @include('address._card', ['address' => Auth::user()->client->defaultAddress, 'default' => true])
            @foreach($addresses as $address)
              @if($address->id != Auth::user()->client->defaultAddress->id)
                @include('address._card', ['address' => $address, 'default' => false])
              @endif
            @endforeach
          </div>
        </div>
      </section>
      <section class="tab-pane fadeIn" id="tab-2">
        @foreach($warehouses as $warehouse)
          <div class="col-lg-4">
            <div class="card">
              <header class="card-heading card-purple">
                <h2 class="card-title">
                  {{ $warehouse->name }}
                </h2>
              </header>
              <div class="card-body">
                <h3>{{ $warehouse->address['owner_name'].' '.$warehouse->address['owner_surname']}}</h3>
                <small class="dataTables_info">{{ __('address.titles.phone').': '}}
                  @foreach($warehouse->phones as $phone)
                    {{ $phone->number . '/' }}
                  @endforeach
                </small>
                <p>{{ $warehouse->address['formatted_address'] }}
                  <small class="dataTables_info">, nº {{ $warehouse->address['number'].', '.__('address.titles.postal_code').': '. $warehouse->address['postal_code'] }}</small></p>
              </div>
            </div>
          </div>
        @endforeach
        <div class="clearfix"></div>
      </section>
    </section>

@endsection

