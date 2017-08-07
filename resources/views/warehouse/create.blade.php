@extends('layouts.app')

@section('content')
<header class="panel-heading">Warehouse</header>
@if(Request::is('*/edit'))
    <?php $action = 'admin.warehouses.update' ?>
    <form action="{{route($action, $warehouse->id)}}" role="form" method="POST">
        <input name="_method" type="hidden" value="PUT">
@else
    <?php $action = 'admin.warehouses.store' ?>
    <form action="{{route($action)}}" role="form" method="POST">
@endif
    <section class="panel-body">
        {{ csrf_field() }}
        @include('warehouse._form')
        @if(Request::is('*/edit'))
            @include('address._form', array('address'=> $warehouse->address))
        @else
            @include('address._form')
        @endif
    </section>
    <footer class="panel-footer">
        <button type="submit" class="btn btn-success pull-right">
            @if(Request::is('*/edit'))
            {{__('buttons.titles.update')}}
            @else
                {{__('buttons.titles.create')}}
            @endif
        </button>
        <div class="clearfix"></div>
    </footer>
</form>
@endsection
