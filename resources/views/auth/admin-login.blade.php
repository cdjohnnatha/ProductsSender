@extends('layouts.app')

@section('content')
<section class="col-sm-6 col-sm-offset-3" id="form-admin">
    <div class="row">
        <div class="panel panel-default">
            <header class="panel-heading">
                Login
            </header>
            <div class="panel-body">
                <form action="{{route('admin.login')}}" role="form" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group col-sm-10 col-sm-offset-1" {{ $errors->has('email') ? ' has-error' : '' }} >
                        <input name="email" class="form-control" type="text" placeholder="Login">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="text-danger" class="alert-danger">
                                  {{ $errors->first('password') }}
                                </strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-sm-10 col-sm-offset-1" {{ $errors->has('password') ? ' has-error' : '' }} >
                        <input name="password" class="form-control" type="password" placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="text-danger" class="alert-danger">
                                  {{ $errors->first('password') }}
                                </strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-1">
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
