<article>
  <section class="row">
    <div class="form-group col-sm-9 label-floating {{ $errors->has('company_warehouse.name') ? 'has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
        <label class="control-label">{{ __('address.titles.admin_name')}}</label>
        <input type="text" class="form-control" name="company_warehouse[name]"
               value="{{ $company_warehouse->name or old('company_warehouse.name') }}" id="company_warehouse_name">

        @if ($errors->has('company_warehouse.name'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('company_warehouse.name') }}
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
               value="{{ $company_warehouse->address->number or old('address.number') }}">
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
          set_address="{{ $company_warehouse->address->formatted_address or old('address.formatted_address')}}"></autocomplete-address>
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
               value="{{ $company_warehouse->address->street2 or old('address.street2') }}">
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
               value="{{ $company_warehouse->address->postal_code or old('address.postal_code') }}">
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
  <input type="hidden" id="city" name="address[city]" value="{{ $company_warehouse->address['city'] or old('address.city')}}">
  <input type="hidden" id="state" name="address[state]" value="{{ $company_warehouse->address['state'] or old('address.state')}}">
  <input type="hidden" id="country" name="address[country]" value="{{ $company_warehouse->address['country'] or old('address.country')}}">
  <input type="hidden" id="street" name="address[street]" value="{{ $company_warehouse->address['street'] or old('address.street')}}">
  <input type="hidden" id="formatted_address" name="address[formatted_address]"
         value="{{ $company_warehouse->address['formatted_address'] or old('address.formated_address')}}">


  <input type="hidden" id="geonames_country" name="geonames[country]"
         value="{{ $company_warehouse->address->geonames['country'] or old('geonames.country')}}">
  <input type="hidden" id="geonames_city" name="geonames[city]"
         value="{{ $company_warehouse->address->geonames->city or old('geonames.city')}}">
  <input type="hidden" id="geonames_state" name="geonames[state]"
         value="{{ $company_warehouse->address->geonames->state or old('geonames.state')}}">

  <section class="row">
    <section class="form-group col-sm-4 label-floating
        {{ $errors->has('company_warehouse.storage_time') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-alarm"></i></span>
        <label class="control-label">{{__('warehouse.form.storage_time').' ('. __('common.calendar.days').')'}}</label>
        <input type="number" min="0" name="company_warehouse[storage_time]" class="form-control"
               value="{{ $company_warehouse->storage_time or old('company_warehouse.storage_time') }}">
        @if ($errors->has('company_warehouse.storage_time'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('company_warehouse.storage_time') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

    <section class="form-group col-sm-4 {{ $errors->has('company_warehouse.box_price') ? ' has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
        <label class="control-label">{{__('warehouse.form.box_price')}}</label>
        <input type="number" min="0.00" step="0.01" name="company_warehouse[box_price]" class="form-control" placeholder=""
               value="{{ $company_warehouse->box_price or old('company_warehouse.box_price') }}">
      </div>

      @if ($errors->has('company_warehouse.box_price'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('company_warehouse.box_price') }}
          </strong>
        </span>
      @endif
    </section>

    <section class="form-group col-sm-4">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
        <select class="select form-control" name="company_warehouse[company_id]">
          @foreach($companies as $company)
            <option value="{{$company->id or old('company_warehouse.company_id')}}">
              {{$company->name}}
            </option>
          @endforeach
        </select>
        @if ($errors->has('company'))
          <span class="help-block">
        <strong class="text-danger" class="alert-danger">
          {{ $errors->first('company') }}
        </strong>
    </span>
        @endif
      </div>
    </section>
  </section>

  <section class="row">
    <div class="col-sm-12">
      @if(Request::is('*/edit'))
        <phones-component :editing="{{$company_warehouse->phones}}"></phones-component>
      @else
        <phones-component></phones-component>
      @endif
    </div>
  </section>
</article>
