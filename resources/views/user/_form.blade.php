<article>
  <section class="row">
    <div class="form-group col-sm-6 label-floating {{ $errors->has('client.name') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <label class="control-label">@lang('auth.register.name')</label>
        <input type="text" class="form-control" name="client[name]" value="{{ $client->name or old('client.name') }}">

        @if ($errors->has('client.name'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('client.name') }}
            </strong>
          </span>
        @endif
      </div>
    </div>
    <div class="form-group col-sm-6 {{ $errors->has('client.surname') ? ' has-error' : '' }} label-floating">
      <label class="control-label">@lang('auth.register.surname')</label>
      <input type="text" class="form-control" name="client[surname]"
             value="{{ $client->surname or old('client.surname') }}">

      @if ($errors->has('client.surname'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('client.surname') }}
          </strong>
        </span>
      @endif
    </div>

  </section>

  <section class="row">
    <div class="form-group col-sm-6 label-floating {{ $errors->has('client.identity_document') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
        <label class="control-label" for="identity_document">@lang('auth.register.identity_document')</label>
        <input type="text" class="form-control" name="client[identity_document]"
               value="{{ $client->identity_document or old('client.identity_document') }}" id="identity_document">

        @if ($errors->has('client.identity_document'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('client.identity_document') }}
            </strong>
          </span>
        @endif
      </div>
    </div>
    <div class="form-group col-sm-6 label-floating {{ $errors->has('client.tax_document') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
        <label class="control-label">@lang('auth.register.tax_document')</label>
        <input type="text" class="form-control" name="client[tax_document]"
               value="{{ $client->tax_document or old('client.tax_document') }}">

        @if ($errors->has('client.tax_document'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('client.tax_document') }}
            </strong>
          </span>
        @endif
      </div>
    </div>

  </section>

  <section class="row">
    <div class="col-sm-12">
      <phones-component></phones-component>
    </div>
  </section>

  <section class="row">
    <section class="form-group col-sm-12 {{ $errors->has('user.email') ? ' has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
        <label class="control-label">@lang('auth.register.email')</label>
        <input type="email" class="form-control" name="{{ Request::is('*/edit') ? 'email' : 'user[email]'}}" value="{{ $user->email or old('user.email') }}">

        @if ($errors->has('user.email'))
          <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('user.email') }}
          </strong>
        </span>
        @endif
      </div>
    </section>

  </section>

  <section class="row">
    <div class="form-group col-sm-6  label-floating {{ $errors->has('password') ? 'has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
        <label class="control-label">@lang('auth.register.password')</label>
        <input type="password" class="form-control" name="user[password]"
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
      <label class="control-label">@lang('auth.register.password_confirm')</label>
      <input type="password" class="form-control" name="user[password_confirmation]">
    </div>
  </section>
</article>