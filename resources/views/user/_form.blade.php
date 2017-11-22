<article>
  <section class="row">
    <div class="form-group col-sm-6 label-floating {{ $errors->has('client.name') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <label class="control-label">{{__('common.titles.name')}}</label>
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
      <label class="control-label">{{__('common.titles.surname')}}</label>
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
    <div class="form-group col-sm-6 label-floating {{ $errors->has('client.rg') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
        <label class="control-label" for="rg">{{__('common.titles.rg')}}</label>
        <input type="text" class="form-control" name="client[rg]"
               value="{{ $client->rg or old('client.rg') }}" id="rg">

        @if ($errors->has('client.rg'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('client.rg') }}
            </strong>
          </span>
        @endif
      </div>
    </div>
    <div class="form-group col-sm-6 label-floating {{ $errors->has('client.cpf') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
        <label class="control-label">{{__('common.titles.cpf')}}</label>
        <input type="text" class="form-control" name="client[cpf]"
               value="{{ $client->cpf or old('client.cpf') }}">

        @if ($errors->has('client.cpf'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('client.cpf') }}
            </strong>
          </span>
        @endif
      </div>
    </div>

  </section>

  <section class="row">
    <section class="form-group col-sm-7 {{ $errors->has('user.email') ? ' has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
        <label class="control-label">Email</label>
        <input type="email" class="form-control" name="{{Request::is('*/edit') ? 'email' : 'user[email]'}}" value="{{ $user->email or old('user.email') }}">

        @if ($errors->has('user.email'))
          <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('user.email') }}
          </strong>
        </span>
        @endif
      </div>
    </section>

    <section class="form-group col-sm-5 {{ $errors->has('client.phone') ? ' has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
        <label class="control-label">{{__('common.titles.phone')}}</label>
        <input type="text" class="form-control" name="client[phone]"
               value="{{ $client->phone or old('client.phone') }}">

        @if ($errors->has('client.phone'))
          <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('client.phone') }}
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
        <label class="control-label">{{__('common.titles.password')}}</label>
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
      <label class="control-label">{{__('common.titles.password_confirm')}}</label>
      <input type="password" class="form-control" name="user[password_confirmation]">
    </div>
  </section>
</article>