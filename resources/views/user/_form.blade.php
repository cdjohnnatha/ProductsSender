
<section class="form-group">
    <div class="col-sm-4" {{ $errors->has('users.name') ? ' has-error' : '' }}>
        <label for="name">{{__('common.titles.name')}}</label>
        <input type="text" name="users[name]" id="name" class="form-control"
               value="{{$user->name or old('users.name')}}">

        @if ($errors->has('name'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">{{ $errors->first('users.name') }}</strong>
          </span>
        @endif
    </div>
    <div class="col-sm-4" {{ $errors->has('users.surname') ? ' has-error' : '' }}>
        <label for="surname">Surname</label>
        <input type="text" name="users[surname]" id="surname" class="form-control"
               value="{{$user->surname or old('users.surname')}}">

        @if ($errors->has('users.surname'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">{{ $errors->first('users.surname') }}</strong>
          </span>
        @endif
    </div>
    <div class="col-sm-4">
        <label for="country">Country</label>
        <input type="text" name="users[country]" class="form-control">
    </div>
</section>

<section class="form-group">
    <div class="col-sm-8" {{ $errors->has('users.email') ? ' has-error' : '' }}>
        <label for="email">Email</label>
        <input type="email" name="users[email]" id="email" class="form-control"
        value="{{$user->email or old('users.email')}}">

        @if ($errors->has('users.email'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">{{ $errors->first('users.email') }}</strong>
          </span>
        @endif
    </div>
    <div class="form-group col-sm-4" {{ $errors->has('users.phone') ? ' has-error' : '' }}>
        <label for="phone">Phone</label>
        <input type="text" name="users[phone]" id="phone" class="form-control"
        value="{{$user->phone or old('users.phone')}}">

        @if ($errors->has('users.phone'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">{{ $errors->first('users.phone') }}</strong>
          </span>
        @endif
    </div>
</section>

<section class="form-group">
    <div class="col-sm-6" {{ $errors->has('users.password') ? ' has-error' : '' }}>
        <label for="passoword">Passoword</label>
        <input id="password" type="password" class="form-control" name="users[password]">

        @if ($errors->has('users.password'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">{{ $errors->first('users.password') }}</strong>
          </span>
        @endif
    </div>

    <div class="col-sm-6">
        <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="users[password_confirmation]">

    </div>
</section>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif