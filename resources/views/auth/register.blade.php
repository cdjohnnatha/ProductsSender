@extends('layouts.app')

@section('content')

  <section class="container col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
      <div class="panel-heading">Register</div>
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}
          <section class="panel-body">
                <section id="userInfo">
                  @include('user._form')
                </section>
                <section id="addressSection">
                  @include('address._form')
                </section>
                <section>
                  <input type="hidden" name="subscription_id" value="1">
                </section>
          </section>
          <footer class="panel-footer ">
            <button type="submit" class="btn btn-info pull-right">Send</button>
            <div class="clearfix"></div>
          </footer>

        </form>
          {{--<register-form-button></register-form-button>--}}
        </div>
  </section>

@endsection
