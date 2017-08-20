<article>
  <section class="row">
    <div class="form-group col-sm-6 {{ $errors->has('name') ? ' has-error has-feedback is-empty' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <input type="text" class="form-control" placeholder="Name" name="name"
               value="{{ $admin->name or old('name') }}">

        @if ($errors->has('name'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('name') }}
            </strong>
          </span>
        @endif
      </div>
    </div>
    <div class="form-group col-sm-6 {{ $errors->has('surname') ? ' has-error' : '' }}">
      <input type="text" class="form-control" placeholder="Surname" name="surname"
             value="{{ $admin->surname or old('surname') }}">

      @if ($errors->has('surname'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('surname') }}
          </strong>
        </span>
      @endif
    </div>
  </section>

  <section class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
      <input type="email" class="form-control" placeholder="Email Address" name="email"
             value="{{ $admin->email or old('email') }}">

      @if ($errors->has('email'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('email') }}
          </strong>
        </span>
      @endif
    </div>
  </section>

  <section class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
      <input type="text" class="form-control" placeholder="Phone Number" name="phone"
             value="{{ $admin->email or old('email') }}">

      @if ($errors->has('phone'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('phone') }}
          </strong>
        </span>
      @endif
    </div>
  </section>

  <section class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
      {{--<countries-list set_address="{{$admin->country or old('country')}}"></countries-list>--}}
    </div>
  </section>

  <section class="row">
    <div class="form-group col-sm-6 {{ $errors->has('password') ? 'has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
        <input type="text" class="form-control" placeholder="Password" name="password"
               value="{{ old('password') }}">


      @if ($errors->has('password'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('password') }}
            </strong>
          </span>
        <span class="zmdi zmdi-close form-control-feedback"></span>
        @endif
      </div>
    </div>

    <div class="form-group col-sm-6 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
      <input type="text" class="form-control" placeholder="Confirm Password">
    </div>
  </section>
</article>