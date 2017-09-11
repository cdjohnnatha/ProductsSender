<article>
  <section class="row">
    <div class="form-group col-sm-6 label-floating {{ $errors->has('user.name') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <label class="control-label">{{__('common.titles.name')}}</label>
        <input type="text" class="form-control" name="user[name]"
               value="{{ $user->name or old('user.name') }}">

        @if ($errors->has('user.name'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('user.name') }}
            </strong>
          </span>
        @endif
      </div>
    </div>
    <div class="form-group col-sm-6 {{ $errors->has('user.surname') ? ' has-error' : '' }} label-floating">
      <label class="control-label">{{__('common.titles.surname')}}</label>
      <input type="text" class="form-control" name="user[surname]"
             value="{{ $user->surname or old('user.surname') }}">

      @if ($errors->has('user.surname'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('user.surname') }}
          </strong>
        </span>
      @endif
    </div>

  </section>

  <section class="row">
    <div class="form-group col-sm-6 label-floating {{ $errors->has('user.rg') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
        <label class="control-label" for="rg">{{__('common.titles.rg')}}</label>
        <input type="text" class="form-control" name="user[rg]"
               value="{{ $user->rg or old('user.rg') }}" id="rg">

        @if ($errors->has('user.rg'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('user.rg') }}
            </strong>
          </span>
        @endif
      </div>
    </div>
    <div class="form-group col-sm-6 label-floating {{ $errors->has('user.cpf') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account-box"></i></span>
        <label class="control-label">{{__('common.titles.cpf')}}</label>
        <input type="text" class="form-control" name="user[cpf]"
               value="{{ $user->cpf or old('user.cpf') }}">

        @if ($errors->has('user.cpf'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('user.cpf') }}
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
        <input type="email" class="form-control" name="user[email]" value="{{ $user->email or old('user.email') }}">

        @if ($errors->has('user.email'))
          <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('user.email') }}
          </strong>
        </span>
        @endif
      </div>
    </section>

    <section class="form-group col-sm-5 {{ $errors->has('user.phone') ? ' has-error' : '' }} label-floating">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
        <label class="control-label">{{__('common.titles.phone')}}</label>
        <input type="text" class="form-control" name="user[phone]"
               value="{{ $user->phone or old('user.phone') }}">

        @if ($errors->has('user.phone'))
          <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('user.phone') }}
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
  @if(Request::is('admin/*'))
    <section>
      <div class="form-group label-floating">
        <div class="input-group">
          <span class="input-group-addon"><i class="zmdi zmdi-card-membership"></i></span>
          <label class="control-label">{{__('common.titles.plan')}}</label>
          <select class="select form-control" name="user[subscription_id]">
            @foreach($subscriptions as $subscription)
              <option value="{{$subscription->id or old('user.subscription_id')}}">
                {{$subscription->title.' - $'.$subscription->amount}}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </section>
  @endif
</article>

















{{--<section class="form-group">--}}
    {{--<div class="col-sm-4" {{ $errors->has('users.name') ? ' has-error' : '' }}>--}}
        {{--<label for="name">{{__('common.titles.name')}}</label>--}}
        {{--<input type="text" name="users[name]" id="name" class="form-control"--}}
               {{--value="{{$user->name or old('users.name')}}">--}}

        {{--@if ($errors->has('name'))--}}
            {{--<span class="help-block">--}}
              {{--<strong class="text-danger" class="alert-danger">{{ $errors->first('users.name') }}</strong>--}}
          {{--</span>--}}
        {{--@endif--}}
    {{--</div>--}}
    {{--<div class="col-sm-4" {{ $errors->has('users.surname') ? ' has-error' : '' }}>--}}
        {{--<label for="surname">Surname</label>--}}
        {{--<input type="text" name="users[surname]" id="surname" class="form-control"--}}
               {{--value="{{$user->surname or old('users.surname')}}">--}}

        {{--@if ($errors->has('users.surname'))--}}
            {{--<span class="help-block">--}}
              {{--<strong class="text-danger" class="alert-danger">{{ $errors->first('users.surname') }}</strong>--}}
          {{--</span>--}}
        {{--@endif--}}
    {{--</div>--}}
    {{--<div class="col-sm-4">--}}
        {{--<label for="country">Country</label>--}}
        {{--<input type="text" name="users[country]" class="form-control">--}}
    {{--</div>--}}
{{--</section>--}}

{{--<section class="form-group">--}}
    {{--<div class="col-sm-8" {{ $errors->has('users.email') ? ' has-error' : '' }}>--}}
        {{--<label for="email">Email</label>--}}
        {{--<input type="email" name="users[email]" id="email" class="form-control"--}}
        {{--value="{{$user->email or old('users.email')}}">--}}

        {{--@if ($errors->has('users.email'))--}}
            {{--<span class="help-block">--}}
              {{--<strong class="text-danger" class="alert-danger">{{ $errors->first('users.email') }}</strong>--}}
          {{--</span>--}}
        {{--@endif--}}
    {{--</div>--}}
    {{--<div class="form-group col-sm-4" {{ $errors->has('users.phone') ? ' has-error' : '' }}>--}}
        {{--<label for="phone">Phone</label>--}}
        {{--<input type="text" name="users[phone]" id="phone" class="form-control"--}}
        {{--value="{{$user->phone or old('users.phone')}}">--}}

        {{--@if ($errors->has('users.phone'))--}}
            {{--<span class="help-block">--}}
              {{--<strong class="text-danger" class="alert-danger">{{ $errors->first('users.phone') }}</strong>--}}
          {{--</span>--}}
        {{--@endif--}}
    {{--</div>--}}
{{--</section>--}}

{{--<section class="form-group">--}}
    {{--<div class="col-sm-6" {{ $errors->has('users.password') ? ' has-error' : '' }}>--}}
        {{--<label for="passoword">Passoword</label>--}}
        {{--<input id="password" type="password" class="form-control" name="users[password]">--}}

        {{--@if ($errors->has('users.password'))--}}
            {{--<span class="help-block">--}}
              {{--<strong class="text-danger" class="alert-danger">{{ $errors->first('users.password') }}</strong>--}}
          {{--</span>--}}
        {{--@endif--}}
    {{--</div>--}}

    {{--<div class="col-sm-6">--}}
        {{--<label for="password-confirm">Confirm Password</label>--}}
        {{--<input id="password-confirm" type="password" class="form-control" name="users[password_confirmation]">--}}

    {{--</div>--}}
{{--</section>--}}

{{--@if ($errors->any())--}}
  {{--<div class="alert alert-danger">--}}
    {{--<ul>--}}
      {{--@foreach ($errors->all() as $error)--}}
        {{--<li>{{ $error }}</li>--}}
      {{--@endforeach--}}
    {{--</ul>--}}
  {{--</div>--}}
{{--@endif--}}