<article>
  <section class="row">

    <div class="form-group col-sm-6 label-floating {{ $errors->has('address.label') ? 'has-error' : '' }}">
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

    <div class="form-group col-sm-4 label-floating {{ $errors->has('address.phone') ? ' has-error' : '' }} label-floating">
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
    </div>

    <div class="form-group col-sm-2 label-floating {{ $errors->has('address.number') ? 'has-error' : '' }}">
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

    <div class="form-group col-sm-5 {{ $errors->has('address.street2') ? ' has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
        <label class="control-label">{{__('address.titles.street2')}}</label>
        <input type="text" class="form-control" name="address[street2]"
               value="{{ $address->street2 or old('address.street2') }}">
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