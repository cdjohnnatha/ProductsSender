<section>
  <div class="form-group col-sm-12" >
    <div class="col-sm-5" {{ $errors->has('address.label') ? ' has-error' : '' }}>
      <label>{{$title}}</label>
      <input type="text" class="form-control" id="label-name" name="address[label]"
             value="{{$address->label or old('address.label') }}">

      @if ($errors->has('address.label'))
        <span class="help-block">
            <strong class="text-danger" class="alert-danger">{{ $errors->first('address.label') }}</strong>
        </span>
      @endif
    </div>

    <div class="col-sm-4" {{ $errors->has('address.owner_name') ? ' has-error' : '' }}>
      <label>{{ __('address.titles.first_name') }}</label>
      <input type="text" class="form-control" name="address[owner_name]"
             value="{{$address->owner_name or old('address.owner_name') }}"
             required autofocus>
      @if ($errors->has('address.owner_name'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('address.owner_name') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-3" {{ $errors->has('address.owner_surname') ? ' has-error' : '' }}>
      <label>{{ __('address.titles.last_name') }}</label>
      <input type="text" class="form-control" name="address[owner_surname]"
             value="{{$address->owner_surname or old('address.owner_surname') }}"
             required autofocus>
      @if ($errors->has('address.owner_name'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('address.owner_surname') }}</strong>
        </span>
      @endif
    </div>
  </div>

  <div class="form-group col-sm-12" >
    <div class="col-sm-3" {{ $errors->has('address.phone') ? ' has-error' : '' }}>
      <label>{{ __('address.titles.phone') }}</label>
      <input id="phone" type="text" class="form-control" name="address[phone]"
             value="{{ $address->phone or old('address.phone') }}">

      @if ($errors->has('address.phone'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('address.phone') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-3" {{ $errors->has('address.company_name') ? ' has-error' : '' }}>
      <label>{{ __('address.titles.company') }}</label>
      <input type="text" class="form-control" name="address[company_name]" id="company_name"
             value="{{ $address->company_name or old('address.company_name') }}">

      @if ($errors->has('address.company_name'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('address.company_name') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-6">
      <label>{{ __('address.titles.address') }}</label>
      {{--<input type="text" class="form-control" name="address[address]"--}}
             {{--value="{{ $address->address or old('address.address') }}">--}}

      <countries-list></countries-list>
      @if ($errors->has('address.address'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('address.address') }}</strong>
        </span>
      @endif
    </div>
  </div>


  <div class="form-group col-sm-12" {{ $errors->has('address.city') ? ' has-error' : '' }}>
    <div class="col-sm-4">
      <label>{{ __('address.titles.city') }}</label>
      <input type="text" class="form-control" name="address[city]" id="city"
             value="{{ $address->city or old('address.city') }}">

      @if ($errors->has('address.city'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('address.city') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-3" {{ $errors->has('address.state') ? ' has-error' : '' }}>
      <label>{{ __('address.titles.state') }}</label>
      <input type="text" class="form-control" name="address[state]" id="state"
             value="{{ $address->state or old('address.state') }}">

      @if ($errors->has('address.state'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('address.state') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-2" {{ $errors->has('address.postal_code') ? ' has-error' : '' }}>
      <label>{{ __('address.titles.postal_code') }}</label>
      <input type="text" class="form-control" name="address[postal_code]"
             value="{{ $address->postal_code or old('address.postal_code') }}" >

      @if ($errors->has('address.postal_code'))
        <span class="help-block">
          <strong class="text-danger">{{ $errors->first('address.postal_code') }}</strong>
        </span>
      @endif
    </div>
    <div class="col-sm-3">
      <label>{{ __('address.titles.country') }}</label>
      <input type="hidden" name="address[country]" value="Brasil">
    </div>
  </div>
</section>