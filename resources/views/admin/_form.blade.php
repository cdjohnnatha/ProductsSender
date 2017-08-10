<article>
  <section class="form-group col-sm-12">
    <div class="col-sm-6" {{ $errors->has('name') ? ' has-error' : '' }}>
      <label for="name" class="control-label">Name</label>
      <input id="name" name="name" type="text" class="form-control" value="{{ $admin->name or old('name') }}">

      @if ($errors->has('name'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('name') }}
          </strong>
        </span>
      @endif
    </div>
    <div class="col-sm-6" {{ $errors->has('surname') ? ' has-error' : '' }} >
      <label for="surname" class="control-label">Surname</label>
      <input type="text" class="form-control" id="surname" name="surname"
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
  <section class="form-group col-sm-12">
    <div class="col-sm-6" {{ $errors->has('phone') ? ' has-error' : '' }}>
      <label for="phone" class="control-label">Phone</label>
      <input id="phone" type="text" class="form-control" name="phone"
             value="{{ $admin->phone or old('phone') }}">

      @if ($errors->has('phone'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('phone') }}
          </strong>
        </span>
      @endif
    </div>

    <div class="col-sm-6">
      <label class="control-label" >Country</label>
      <input type="hidden" value="BR" value="{{$admin->country or old('country') }}">
    </div>
  </section>

  <section class="form-group col-sm-12">
    <div class="col-sm-12" {{ $errors->has('email') ? ' has-error' : '' }}>
      <label for="email" class="control-label">E-Mail</label>
      <input id="email" type="email" class="form-control" name="email"
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
      <section class="form-group col-sm-12">

      <div class="col-sm-6" {{ $errors->has('email') ? ' has-error' : '' }}>
        <label for="password" class="control-label">Password</label>
        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">

        @if ($errors->has('password'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('password') }}
            </strong>
          </span>
        @endif
      </div>
      <div class="col-sm-6" {{ $errors->has('password_confirmation') ? ' has-error' : '' }}>
        <label for="password-confirm" class="control-label">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
               value="{{ old('password_confirmation') }}">

        @if ($errors->has('password_confirmation'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('password_confirmation') }}
            </strong>
          </span>
        @endif
      </div>
    </section>
</article>