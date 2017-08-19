<section class="col-sm-offset-1 col-xs-12 col-md-7" id="form-admin">
  <div class="card">
    <header class="card-heading p-b-0">
      <h2 class="card-title">{{$title_user_login}}</h2>
      <ul class="card-actions icons right-top">
        <li>
          <a href="javascript:void(0)" data-toggle-view="code">
            <i class="zmdi zmdi-code"></i>
          </a>
        </li>
      </ul>
    </header>
    <div class="card-body">
      <form action="{{route($user_type.'login')}}" role="form" method="POST">
        {{ csrf_field() }}
        <div class="form-group" {{ $errors->has('email') ? ' has-error' : '' }}>
          <label class="form-control-label" for="inputInlineUsername">Username: </label>
          <input type="text" class="form-control" id="inputInlineUsername" name="email"
                 placeholder="Username" autocomplete="off" />
          @if ($errors->has('email'))
            <span class="help-block">
                <strong class="text-danger" class="alert-danger">
                  {{ $errors->first('email') }}
                </strong>
            </span>
          @endif

        </div>
        <div class="form-group">
          <label class="form-control-label" for="inputInlinePassword">Password: </label>
          <div class="input-group">
            <input type="password" class="form-control" id="inputInlinePassword" name="password"
                   placeholder="Password" autocomplete="off" {{ $errors->has('password') ? ' has-error' : '' }} />

            @if ($errors->has('password'))
              <span class="help-block">
                  <strong class="text-danger" class="alert-danger">
                    {{ $errors->first('password') }}
                  </strong>
              </span>
            @endif
            <span class="input-group-btn">
              <button type="submit" class="btn btn-blue btn-fab animate-fab btn-fab-sm">
                <i class="zmdi zmdi-mail-send"></i>
              </button>
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>