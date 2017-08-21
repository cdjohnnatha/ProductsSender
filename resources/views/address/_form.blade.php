<article>
    <div class="form-group {{ $errors->has('address.label') ? 'has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
        <input type="text" class="form-control" placeholder="{{$title}}" name="address[label]"
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
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-male-alt"></i></span>
        @include('admin._select')
      </div>
    </div>
  @else
    <section class="row">
      <div class="form-group col-sm-6 {{ $errors->has('address.owner_name') ? 'has-error' : '' }}">
        <div class="input-group">
          <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
          <input type="text" class="form-control" placeholder="{{__('common.titles.name')}}" name="address[owner_name]"
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


    <div class="form-group col-sm-6 {{ $errors->has('address.owner_surname') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
        <input type="text" class="form-control" placeholder="{{__('common.titles.surname')}}" name="address[owner_surname]"
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

  <section class="form-group {{ $errors->has('address.phone') ? ' has-error' : '' }}">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
      <input type="text" class="form-control" placeholder="Phone Number" name="address[phone]"
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

  <section class="form-group {{ $errors->has('address.formatted_address') ? ' has-error' : '' }}">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
      <countries-list set_address="{{$address->formatted_address or old('address.formatted_address')}}"></countries-list>

      @if ($errors->has('address.formatted_address'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('address.phone') }}
          </strong>
        </span>
      @endif
    </div>
  </section>

  <section class="row">
    <div class="form-group col-sm-6 {{ $errors->has('address.number') ? 'has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
        <input type="text" class="form-control" placeholder="{{__('address.titles.number')}}" name="address[number]"
               value="{{ $address->number or old('address.number') }}">
      </div>
      @if ($errors->has('address.number'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('address.number') }}
          </strong>
        </span>
      @endif
    </div>


    <div class="form-group col-sm-6 {{ $errors->has('address.postal_code') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
        <input type="text" class="form-control" placeholder="{{__('address.titles.postal_code')}}" name="address[postal_code]"
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
</article>














