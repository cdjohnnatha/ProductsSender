@extends('layouts.app')

@section('panel_header')
    Warehouses
@endsection


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
<section class="content-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <header class="card-heading ">
                    <h2 class="card-title">{{__('warehouse.form.main_title')}}</h2>
                </header>
                @if(Request::is('*/edit'))
                    <?php $action = 'admin.companies.warehouses.update' ?>
                        <form action="{{route($action, [$companyId, $companyWarehouse->id])}}" role="form" method="POST">
                        <input name="_method" type="hidden" value="PUT">
                    @else
                        <?php $action = 'admin.companies.warehouses.store' ?>
                        <form action="{{route($action, $companyId)}}" role="form" method="POST">
                    @endif
                            {{ csrf_field() }}
                            <section class="card-body">
                              <article>
                                <section class="row">
                                  <div class="form-group col-sm-9 label-floating {{ $errors->has('companyWarehouse.name') ? 'has-error' : '' }}">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
                                      <label class="control-label">{{ __('address.titles.admin_name')}}</label>
                                      <input type="text" class="form-control" name="companyWarehouse[name]"
                                             value="{{ $companyWarehouse->name or old('companyWarehouse.name') }}" id="warehouse_name">

                                      @if ($errors->has('companyWarehouse.name'))
                                        <span class="help-block">
                                          <strong class="text-danger" class="alert-danger">
                                            {{ $errors->first('companyWarehouse.name') }}
                                            <span class="zmdi zmdi-close form-control-feedback" aria-hidden="true"></span>
                                          </strong>
                                        </span>
                                      @endif
                                    </div>
                                  </div>

                                  <div class="form-group col-sm-3 label-floating {{ $errors->has('address.number') ? 'has-error' : '' }}">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
                                      <label class="control-label">{{__('address.titles.number')}}</label>
                                      <input type="text" class="form-control" name="address[number]"
                                             value="{{ $companyWarehouse->address['number'] or old('address.number') }}">
                                    </div>
                                    @if ($errors->has('address.number'))
                                      <span class="help-block">
                                        <strong class="text-danger" class="alert-danger">
                                          {{ $errors->first('address.number') }}
                                        </strong>
                                      </span>
                                    @endif
                                  </div>
                                </section>

                                <section class="row">
                                  <div class="form-group col-sm-5 label-floating
                                    {{
                                      $errors->has('address.formatted_address') ||
                                      $errors->has('geonames.country') ||
                                      $errors->has('geonames.city') ||
                                      $errors->has('geonames.state') ||
                                      $errors->has('address.city') ||
                                      $errors->has('address.state') ||
                                      $errors->has('address.country') ||
                                      $errors->has('address.street')  ? 'has-error' : '' }}">

                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
                                      <label class="control-label">{{__('address.label.type_address')}}</label>
                                      <autocomplete-address
                                        set_address="{{ $companyWarehouse->address->formatted_address or old('address.formatted_address')}}"></autocomplete-address>
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
                                             value="{{ $companyWarehouse->address->street2 or old('address.street2') }}">
                                    </div>

                                    @if ($errors->has('address.street2'))
                                      <span class="help-block">
                                        <strong class="text-danger" class="alert-danger">
                                          {{ $errors->first('address.street2') }}
                                        </strong>
                                      </span>
                                    @endif
                                  </div>

                                  <div class="form-group col-sm-2 {{ $errors->has('address.postal_code') ? ' has-error' : '' }} label-floating">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
                                      <label class="control-label">{{__('address.titles.postal_code')}}</label>
                                      <input type="text" class="form-control" name="address[postal_code]"
                                             value="{{ $companyWarehouse->address->postal_code or old('address.postal_code') }}">
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
                                <input type="hidden" name="companyWarehouse[company_id]" value="{{ $companyId }}">
                                <input type="hidden" id="city" name="address[city]" value="{{ $companyWarehouse->address['city'] or old('address.city')}}">
                                <input type="hidden" id="state" name="address[state]" value="{{ $companyWarehouse->address['state'] or old('address.state')}}">
                                <input type="hidden" id="country" name="address[country]" value="{{ $companyWarehouse->address['country'] or old('address.country')}}">
                                <input type="hidden" id="street" name="address[street]" value="{{ $companyWarehouse->address['street'] or old('address.street')}}">
                                <input type="hidden" id="formatted_address" name="address[formatted_address]"
                                       value="{{ $companyWarehouse->address['formatted_address'] or old('address.formated_address')}}">


                                {{--<input type="hidden" id="geonames_country" name="geonames[country]"--}}
                                       {{--value="{{ $companyWarehouse->address->geonames['country'] or old('geonames.country')}}">--}}
                                {{--<input type="hidden" id="geonames_city" name="geonames[city]"--}}
                                       {{--value="{{ $companyWarehouse->address->geonames->city or old('geonames.city')}}">--}}
                                {{--<input type="hidden" id="geonames_state" name="geonames[state]"--}}
                                       {{--value="{{ $companyWarehouse->address->geonames->state or old('geonames.state')}}">--}}

                                <section class="row">
                                  <section class="form-group col-sm-4 label-floating
                                    {{ $errors->has('companyWarehouse.storage_time') ? ' has-error' : '' }}">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-alarm"></i></span>
                                      <label class="control-label">{{__('warehouse.form.storage_time').' ('. __('common.calendar.days').')'}}</label>
                                      <input type="number" min="0" name="companyWarehouse[storage_time]" class="form-control"
                                             value="{{ $companyWarehouse->storage_time or old('companyWarehouse.storage_time') }}">
                                      @if ($errors->has('companyWarehouse.storage_time'))
                                        <span class="help-block">
                                          <strong class="text-danger" class="alert-danger">
                                            {{ $errors->first('companyWarehouse.storage_time') }}
                                          </strong>
                                        </span>
                                      @endif
                                    </div>
                                  </section>

                                  <section class="form-group col-sm-4 {{ $errors->has('companyWarehouse.box_price') ? ' has-error' : '' }} label-floating">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                                      <label class="control-label">{{__('warehouse.form.box_price')}}</label>
                                      <input type="number" min="0.00" step="0.01" name="companyWarehouse[box_price]" class="form-control" placeholder=""
                                             value="{{ $companyWarehouse->box_price or old('warehouse') }}">
                                    </div>

                                    @if ($errors->has('companyWarehouse.box_price'))
                                      <span class="help-block">
                                        <strong class="text-danger" class="alert-danger">
                                          {{ $errors->first('companyWarehouse.box_price') }}
                                        </strong>
                                      </span>
                                    @endif
                                  </section>

                                <section class="row">
                                  <div class="col-sm-12">
                                    @if(Request::is('*/edit'))
                                      <phones-component :editing="{{$companyWarehouse->phones}}"></phones-component>
                                    @else
                                      <phones-component></phones-component>
                                    @endif
                                  </div>
                                </section>
                              </article>
                            </section>
                            <footer class="card-footer text-right">
                                @include('layouts.formButtons._form_save_edit', ['url' => Route('admin.companies.show', $companyId)])
                            </footer>
                        </form>
            </div>
        </div>
    </div>
</section>
@endsection
