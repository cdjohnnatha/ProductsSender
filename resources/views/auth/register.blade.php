@extends('layouts.app')

@section('content')

  <section class="container col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
      <header class="panel-heading">
        <h4>Register</h4>
      </header>
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}
          <section class="panel-body">
            <h4 id="section-header">User Informations</h4>
                <section id="userInfo">
                  @include('user._form')
                </section>
                <section id="addressSection" class="hidden">
                  @include('address._form')
                </section>
                <section>
                  <input type="hidden" name="users[subscription_id]" value="1">
                </section>
          </section>
          <footer class="panel-footer hidden" id="submitSection">
            <button type="submit" class="btn btn-info pull-right" id="submit-button">Send</button>
            <div class="clearfix"></div>
          </footer>

        </form>
          <register-form-button></register-form-button>
        </div>
  </section>

@endsection
