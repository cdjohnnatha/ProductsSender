<article>
  <section class="row">
    <div class="form-group col-sm-6 label-floating {{ $errors->has('name') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <label class="control-label">{{__('admin.form.name')}}</label>
        <input type="text" class="form-control" name="name"
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
    <div class="form-group col-sm-6 {{ $errors->has('surname') ? ' has-error' : '' }} label-floating">
      <label class="control-label">{{__('admin.form.surname')}}</label>
      <input type="text" class="form-control" name="surname"
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

  <section class="form-group {{ $errors->has('email') ? ' has-error' : '' }} label-floating">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
      <label class="control-label">Email</label>
      <input type="email" class="form-control" name="email"
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

  <section class="form-group {{ $errors->has('phone') ? ' has-error' : '' }} label-floating">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
      <label class="control-label">{{__('admin.form.phone')}}</label>
      <input type="text" class="form-control" name="phone"
             value="{{ $admin->phone or old('phone') }}">

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
      <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
      <label class="control-label">{{__('warehouse.form.select_warehouse')}}</label>
      @include('warehouse._select')
    </div>
  </section>

  <section class="row">
    <div class="form-group col-sm-6 {{ $errors->has('password') ? 'has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
        <label class="control-label">{{__('common.titles.password')}}</label>
        <input type="text" class="form-control" name="password"
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

    <div class="form-group col-sm-6 {{ $errors->has('password_confirmation') ? ' has-error' : '' }} label-floating">
      <label class="control-label">{{__('common.titles.password_confirm')}}</label>
      <input type="text" class="form-control" name="password_confirmation">
    </div>
  </section>
</article>