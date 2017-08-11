@extends('layouts.app')

@section('content')
  <header class="panel-heading"> Addresses </header>
  <section class="panel-body">
    <article class="col-sm-4">
      <section class="panel panel-primary">
        <header class="panel-heading">
          <h3>Address: {{ $default->address[0]->label}}</h3>
        </header>
        <section class="panel-body">
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
            <section class="panel-body">
              @include('address.show', ['address' => $address])
            </section>
            {{--<footer class="panel-footer">--}}
              {{--<button class="btn btn-info pull-right">Default</button>--}}
              {{--<div class="clearfix"></div>--}}
            {{--</footer>--}}
          </section>
        </section>
      @endif
    @endforeach
  </section>
@endsection