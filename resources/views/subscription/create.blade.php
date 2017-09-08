@extends('layouts.app')

@section('panel_header')
  {{__('plans.index.title')}}
@endsection

@section('content')
  <section class="content-body">
    <div class="row">
      <div class="col-xs-12">
        <div class="card">
          <header class="card-heading ">
            <h2 class="card-title">{{__('plans.form.form_name')}}</h2>
          </header>
          @if(Request::is('*/edit'))
            <?php $action = 'admin.subscriptions.update' ?>
              <form action="{{route($action, $subscription->id)}}" role="form" method="POST">
              <input name="_method" type="hidden" value="PUT">
          @else
            <?php $action = 'admin.subscriptions.store' ?>
            <form action="{{route($action)}}" role="form" method="POST">
              @endif
              {{ csrf_field() }}
              <section class="card-body">
                @include('subscription._form')

              </section>
              <footer class="card-footer text-right">
                @include('layouts.formButtons._form_save_edit', ['url' => Route('admin.subscriptions.index')])
              </footer>
            </form>
        </div>
      </div>
    </div>
  </section>
@endsection