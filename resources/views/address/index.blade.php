@extends('layouts.app')

@section('content')
  <header class="panel-heading">
    Addresses
    <a href="{{route('user.address.create', Auth::user()->id)}}" class="btn btn-default pull-right">
      <span class="glyphicon glyphicon-plus"></span>
    </a>
    <div class="clearfix"></div>
  </header>
  <section class="panel-body">
    <article class="col-sm-4">
      <section class="panel panel-primary">
        <header class="panel-heading">
          <h3>Address: {{ $default->address[0]->label}}</h3>
        </header>
        <section class="panel-body" style="padding: 0;">
          @include('address.show', ['address' => $default->address[0]])
        </section>
        <footer class="panel-footer">
          Default Address
        </footer>
      </section>
    </article>

    @foreach($morph->address as $address)
      @if($address->default_address != 1)
        <section class="col-sm-4">
          <section class="panel panel-info">
            <header class="panel-heading">
              <h3>Address: {{ $address->label}}</h3>
            </header>
            <section class="panel-body" style="padding: 0;">
              @include('address.show', ['address' => $address])
            </section>
            <footer class="panel-footer">
              <form action="{{route('user.address.store', Auth::user()->id)}}" role="form" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-info pull-right">Make default</button>
                <div class="clearfix"></div>
              </form>
            </footer>
          </section>
        </section>
      @endif
    @endforeach
  </section>
@endsection