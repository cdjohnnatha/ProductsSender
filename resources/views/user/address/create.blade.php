@extends('layouts.app')

@section('panel_header')
  {{__('address.titles.form')}}
@endsection

@section('content')
  <section class="content-body">
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          @if(Request::is('*/edit'))
            <form action="{{ route('user.addresses.update', $address->id) }}" role="form" method="POST">
              <input name="_method" type="hidden" value="PUT">
          @else
              <form action="{{ route('user.addresses.store') }}" role="form" method="POST">
          @endif
            {{ csrf_field() }}
            <section class="card-body">
              @include('address._form', ['title' => 'Give a name for your address'])
            </section>
            <footer class="card-footer text-right">
              @include('layouts.formButtons._form_save_edit', ['url' => route('user.addresses.index')])
            </footer>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection






