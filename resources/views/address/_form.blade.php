<article>
    <div class="form-group {{ $errors->has('address.label') ? 'has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
        <label class="control-label">{{$title}}</label>
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
    <div class="form-group {{ $errors->has('admin_id') ? 'has-error' : '' }}">
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
    <section class="row">
      <div class="form-group col-sm-6 {{ $errors->has('address.owner_name') ? 'has-error' : '' }} label-floating">
        <div class="input-group">
          <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
          <label class="control-label">{{__('common.titles.name')}}</label>
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


    <div class="form-group col-sm-6 {{ $errors->has('address.owner_surname') ? ' has-error' : '' }} label-floating">
      <div class="input-group label-floating ">
        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
        <label class="control-label">{{__('common.titles.surname')}}</label>
        <input type="text" class="form-control" placeholder="" name="address[owner_surname]"
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

  <section class="form-group {{ $errors->has('address.phone') ? ' has-error' : '' }} label-floating">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
      <label class="control-label">{{__('address.titles.phone')}}</label>
      <input type="text" class="form-control" placeholder="" name="address[phone]"
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

  <section class="form-group {{ $errors->has('address.formatted_address') ? ' has-error' : '' }} label-floating">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
      <label class="control-label">{{__('address.label.type_address')}}</label>
      <countries-list set_address="{{ $address->formatted_address or old('address.formatted_address')}}"></countries-list>
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
    <div class="form-group col-sm-6 {{ $errors->has('address.number') ? 'has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
        <label class="control-label">{{__('address.titles.number')}}</label>
        <input type="text" class="form-control" placeholder="" name="address[number]"
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


    <div class="form-group col-sm-6 {{ $errors->has('address.postal_code') ? ' has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
        <label class="control-label">{{__('address.titles.postal_code')}}</label>
        <input type="text" class="form-control" placeholder="" name="address[postal_code]"
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














