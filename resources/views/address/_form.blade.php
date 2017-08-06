<section>
  <div class="form-group col-sm-12" >
    <div class="col-sm-5" {{ $errors->has('label') ? ' has-error' : '' }}>
      <label>{{ __('address.titles.name') }}</label>
      <input type="text" class="form-control" name="label" value="{{$address->label or old('label') }}">

      @if ($errors->has('label'))
        <span class="help-block">
                          <strong class="text-danger" class="alert-danger">{{ $errors->first('label') }}</strong>
                      </span>
      @endif
    </div>

    <div class="col-sm-4" {{ $errors->has('owner_name') ? ' has-error' : '' }}>
      <label>{{ __('address.titles.first_name') }}</label>
      <input type="text" class="form-control" name="owner_name" value="{{$address->owner_name or old('owner_name') }}"
             required autofocus>
      @if ($errors->has('owner_name'))
        <span class="help-block">
                          <strong class="text-danger">{{ $errors->first('owner_name') }}</strong>
                      </span>
      @endif
    </div>
    <div class="col-sm-3" {{ $errors->has('owner_surname') ? ' has-error' : '' }}>
      <label>{{ __('address.titles.last_name') }}</label>
      <input type="text" class="form-control" name="owner_surname" value="{{$address->owner_surname or old('owner_surname') }}"
             required autofocus>
      @if ($errors->has('owner_name'))
        <span class="help-block">
                          <strong class="text-danger">{{ $errors->first('owner_surname') }}</strong>
                      </span>
      @endif
    </div>
  </div>

  <div class="form-group col-sm-12" >
    <div class="col-sm-3" :class="{'has-error': errors.has('phone') }">
      <label>{{ __('address.titles.phone') }}</label>
      <input id="phone" type="text" class="form-control" name="phone" value="{{ $address->phone or old('phone') }}">

      @if ($errors->has('phone'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('phone') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-3" :class="{'has-error': errors.has('company_name') }">
      <label>{{ __('address.titles.company') }}</label>
      <input type="text" class="form-control" name="company" value="{{ $address->company_name or old('company_name') }}">

      @if ($errors->has('company'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('company_name') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-6">
      <label>{{ __('address.titles.address') }}</label>
      <input type="text" class="form-control" name="address" value="{{ $address->address or old('address') }}">

      @if ($errors->has('address'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('address') }}</strong>
        </span>
      @endif
    </div>
  </div>


  <div class="form-group col-sm-12" :class="{'has-error': errors.has('city') }">
    <div class="col-sm-4">
      <label>{{ __('address.titles.city') }}</label>
      <input type="text" class="form-control" name="city" value="{{ $address->city or old('city') }}">

      @if ($errors->has('city'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('city') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-3" :class="{'has-error': errors.has('state') }">
      <label>{{ __('address.titles.state') }}</label>
      <input type="text" class="form-control" name="state" value="{{ $address->state or old('state') }}">

      @if ($errors->has('state'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('state') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-2" :class="{'has-error': errors.has('postal_code') }">
      <label>{{ __('address.titles.postal_code') }}</label>
      <input type="text" class="form-control" name="postal_code"
             value="{{ $address->postal_code or old('postal_code') }}" >

      @if ($errors->has('postal_code'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('postal_code') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-3">
      <label>{{ __('address.titles.country') }}</label>
      <input type="hidden" name="country" value="Brasil">
    </div>
  </div>
</section>