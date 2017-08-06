@extends('layouts.app')

@section('content')
<header class="panel-heading">Warehouse</header>
@if(Request::is('*/edit'))
    <?php $action = 'admin.warehouses.update' ?>
@else
    <?php $action = 'admin.warehouses.store' ?>
@endif
    <form action="{{route($action, $warehouse->id)}}" role="form" method="POST">
    <section class="panel-body">
        @if(Request::is('*/edit'))
            <input name="_method" type="hidden" value="PUT">
        @endif
        {{ csrf_field() }}
        @include('warehouse._form')
        @include('address._form', array('address'=> $warehouse->address))
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
