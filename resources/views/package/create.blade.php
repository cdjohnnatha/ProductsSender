@extends('layouts.app')
@section('content')
    <header class="panel-heading">Subscriptions</header>
    @if(Request::is('*/edit'))
        <?php $action = 'admin.packages.update' ?>
        <form action="{{route($action, $subscription->id)}}" role="form" method="POST" >
        <input name="_method" type="hidden" value="PUT">
    @else
        <?php $action = 'admin.subscriptions.store' ?>
        <form action="{{route($action)}}" role="form" method="POST">
    @endif
        <section class="panel-body">
            {{ csrf_field() }}
            @include('package._form')
        </section>

        @include('layouts.formButtons._form_save_edit', array())

    </form>
@endsection