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
        @if(Request::is('*/edit'))
            @include('address._form', array('address'=> $warehouse->address, 'title' => __('warehouse.form.title_label')))
        @else
            @include('address._form', array('title' => __('warehouse.form.title_label')))
        @endif
        @include('warehouse._form')
    </section>
    <footer class="panel-footer">
           @include('layouts.formButtons._form_save_edit')
        <div class="clearfix"></div>
    </footer>
</form>
@endsection
