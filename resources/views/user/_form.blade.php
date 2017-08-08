
<section class="form-group">
    <div class="col-sm-4" {{ $errors->has('name') ? ' has-error' : '' }}>
        <label for="name">Name</label>
        <input type="text" name="user[name]" id="name" class="form-control"
               value="{{$user->name or old('name')}}">

        @if ($errors->has('surname'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">{{ $errors->first('surname') }}</strong>
          </span>
        @endif
    </div>
    <div class="col-sm-4" {{ $errors->has('surname') ? ' has-error' : '' }}>
        <label for="surname">Surname</label>
        <input type="text" name="user[surname]" id="surname" class="form-control"
               value="{{$user->surname or old('surname')}}">

        @if ($errors->has('surname'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">{{ $errors->first('surname') }}</strong>
          </span>
        @endif
    </div>
    <div class="col-sm-4">
        <label for="country">Country</label>
        <input type="text" name="user[country]" class="form-control">
    </div>
</section>

<section class="form-group">
    <div class="col-sm-8" {{ $errors->has('email') ? ' has-error' : '' }}>
        <label for="email">Email</label>
        <input type="email" name="user[email]" id="email" class="form-control"
        value="{{$user->email or old('email')}}">

        @if ($errors->has('email'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">{{ $errors->first('email') }}</strong>
          </span>
        @endif
    </div>
    <div class="form-group col-sm-4" {{ $errors->has('phone') ? ' has-error' : '' }}>
        <label for="phone">Phone</label>
        <input type="text" name="user[phone]" id="phone" class="form-control"
        value="{{$user->phone or old('phone')}}">

        @if ($errors->has('phone'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">{{ $errors->first('phone') }}</strong>
          </span>
        @endif
    </div>
</section>

<section class="form-group">
    <div class="col-sm-6" {{ $errors->has('password') ? ' has-error' : '' }}>
        <label for="passoword">Passoword</label>
        <input id="password" type="password" class="form-control" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
              <strong class="text-danger" class="alert-danger">{{ $errors->first('password') }}</strong>
          </span>
        @endif
    </div>

    <div class="col-sm-6">
        <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

    </div>
</section>