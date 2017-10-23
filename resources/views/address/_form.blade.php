<article>
  <section class="row">
    <div class="form-group col-sm-4 label-floating {{ $errors->has('address.label') ? 'has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
        <label class="control-label">{{$title}}</label>
        <input type="text" class="form-control" name="address[label]"
               value="{{ $address->label or old('address.label') }}" id="address.label">

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

  @if(Route::is('admin.warehouses.*'))
    <div class="form-group col-sm-4 label-floating {{ $errors->has('admin_id') ? 'has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-male-alt"></i></span>
        @include('admin._select')

        @if ($errors->has('admin_id'))
          <span class="help-block">
        <strong class="text-danger" class="alert-danger">
          {{__('admin.error.select_manager')}}
        </strong>
      </span>
        @endif
      </div>
    </div>
  @else

      <div class="form-group col-sm-4 label-floating {{ $errors->has('address.owner_name') ? 'has-error' : '' }} label-floating">
        <div class="input-group">
          <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
          <label class="control-label">{{__('common.titles.name')}}</label>
          <input type="text" class="form-control" name="address[owner_name]"
                 value="{{ $address->owner_name or old('address.owner_name') }}">
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
        <label class="control-label">{{__('common.titles.surname')}}</label>
        <input type="text" class="form-control" name="address[owner_surname]"
                 value="{{ $address->owner_surname or old('address.owner_surname') }}">
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
  @endif

  <section class="row">
    <section class="form-group col-sm-4 label-floating {{ $errors->has('address.phone') ? ' has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
        <label class="control-label">{{__('address.titles.phone')}}</label>
        <input type="text" class="form-control" name="address[phone]"
               value="{{ $address->phone or old('address.phone') }}">

        @if ($errors->has('address.phone'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('address.phone') }}
            </strong>
          </span>
        @endif
      </div>
    </section>

    @if(!Route::is('admin.warehouses.*'))
      <section class="form-group col-sm-8 label-floating {{ $errors->has('address.company_name') ? ' has-error' : '' }} label-floating">
        <div class="input-group">
          <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
          <label class="control-label">{{__('address.titles.company')}}</label>
          <input type="text" class="form-control" name="address[company_name]"
                 value="{{ $address->company_name or old('address.company_name') }}">

          @if ($errors->has('address.company_name'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">
                {{ $errors->first('address.company_name') }}
              </strong>
            </span>
          @endif
        </div>
      </section>
    @endif

  </section>

  <section class="row">
    <section class="form-group col-sm-2 label-floating {{ $errors->has('address.number') ? 'has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
        <label class="control-label">{{__('address.titles.number')}}</label>
        <input type="text" class="form-control" name="address[number]" value="{{ $address->number or old('address.number') }}">
      </div>
      @if ($errors->has('address.number'))
        <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('address.number') }}
            </strong>
          </span>
      @endif
    </section>

    <div class="form-group col-sm-7 label-floating
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
        <autocomplete-address set_address="{{ $address->formatted_address or old('address.formatted_address')}}"></autocomplete-address>
        @if ($errors->has(['address.formatted_address', 'geonames.country']))
          <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('address.formatted_address') || __('statusMessage.errors.address_autocomplete') }}
          </strong>
        </span>
        @endif
      </div>
    </div>


    <div class="form-group col-sm-3 {{ $errors->has('address.postal_code') ? ' has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
        <label class="control-label">{{__('address.titles.postal_code')}}</label>
        <input type="text" class="form-control" name="address[postal_code]"
               value="{{ $address->postal_code or old('address.postal_code') }}">
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
  <input type="hidden" id="city" name="address[city]" value="{{ $address->city or old('address.city')}}">
  <input type="hidden" id="state" name="address[state]" value="{{ $address->state or old('address.state')}}">
  <input type="hidden" id="country" name="address[country]" value="{{ $address->country or old('address.country')}}">
  <input type="hidden" id="street" name="address[street]" value="{{ $address->street or old('address.street')}}">
  <input type="hidden" id="formatted_address" name="address[formatted_address]" value="{{ $address->formatted_address or old('address.formated_address')}}">


  <input type="hidden" id="geonames_country" name="geonames[country]" value="{{ $address->geonames->country or old('geonames.country')}}">
  <input type="hidden" id="geonames_city" name="geonames[city]" value="{{ $address->geonames->city or old('geonames.city')}}">
  <input type="hidden" id="geonames_state" name="geonames[state]" value="{{ $address->geonames->state or old('geonames.state')}}">
</article>
















