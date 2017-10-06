@extends('layouts.app')


@section('panel_header')
  {{__('common.titles.address')}}
@endsection

@section('content')
  <section class="card">
    <header class="card-body p-0">
      <div class="tabpanel">
        <ul class="nav nav-tabs nav-tabs-right">
          <li class="active" role="presentation"><a href="#tab-1" data-toggle="tab" aria-expanded="true">{{__('common.titles.address')}}</a></li>
          <li role="presentation"><a href="#tab-2" data-toggle="tab" aria-expanded="true">{{__('common.titles.warehouse')}}</a></li>
        </ul>
      </div>
    </header>

    <header class="card-heading">
      <h2 class="card-title">{{__('common.titles.address')}}</h2>
      <small class="dataTables_info">{{__('address.label.short_description')}}</small>
      <ul class="card-actions icons fab-action right-bottom">
        <li>
          <button class="btn btn-primary btn-fab btn-fab-sm animate-fab" onclick="window.location='{{Route('user.address.create')}}'">
            <i class="zmdi zmdi-plus"></i>
          </button>
        </li>
      </ul>
    </header>


    <section class="tab-content  p-20">
      <section class="tab-pane fadeIn active" id="tab-1">
        <div class="row">
          <div class="card-body p-0">
            @include('address._card', ['address' => Auth::user()->defaultAddress, 'default' => true])
            @foreach($morph->address as $address)
              @if($address->id != Auth::user()->defaultAddress->id)
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
                  @if($warehouse->address->default_address)
                    <i class="zmdi zmdi-star"></i>
                  @endif
                  {{$warehouse->address->label}}
                </h2>
              </header>
              <div class="card-body">
                <h3>{{$warehouse->address->owner_name.' '.$warehouse->address->owner_surname}}</h3>
                <small class="dataTables_info">{{__('address.titles.phone').': '.$warehouse->address->phone}}</small>
                <p>{{$warehouse->address->formatted_address}}
                  <small class="dataTables_info">, nº {{$warehouse->address->number.', '.__('address.titles.postal_code').': '. $warehouse->address->postal_code}}</small></p>
              </div>
              {{--<footer class="card-footer border-top">--}}
                {{--<ul class="card-actions left-bottom">--}}
                  {{--<li>--}}
                    {{--<a href="javascript:void(0)" class="btn btn-flat {{$warehouse->address->default_address ? 'btn-default disabled' : 'btn-info'}}"--}}
                       {{--onclick="$('#form-makedefault-{{$warehouse->address->id}}').submit();">--}}
                      {{--<i class="zmdi {{$warehouse->address->default_address ? 'zmdi-star' : 'zmdi-star-border'}}"></i> Make default--}}
                    {{--</a>--}}
                    {{--<form action="{{Route('user.address.default', $warehouse->address->id)}}"--}}
                          {{--role="form" method="POST" id="form-makedefault-{{$warehouse->address->id}}">--}}
                      {{--{{ csrf_field() }}--}}
                    {{--</form>--}}
                  {{--</li>--}}
                {{--</ul>--}}
              {{--</footer>--}}
            </div>
          </div>
        @endforeach
        <div class="clearfix"></div>
      </section>
    </section>

@endsection

