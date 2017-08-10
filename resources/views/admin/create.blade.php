@extends('layouts.app')

@section('content')
<header class="panel-heading">Admin</header>
@if(Request::is('*/edit'))
    <?php $action = 'admin.update' ?>
@else
    <?php $action = 'admin.store' ?>
@endif
    <form action="{{route($action, $admin->id)}}" role="form" method="POST">
    <section class="panel-body">
        @if(Request::is('*/edit'))
            <input name="_method" type="hidden" value="PUT">
        @endif
        {{ csrf_field() }}
        @include('admin._form')
        <input type="hidden" name="country" value="BR">
        <input type="hidden" name="default_warehouse_id" id="default_warehouse_id" value="2">
    </section>
    <footer class="panel-footer">
        @include('layouts.formButtons._form_save_edit', ['url' => route('admin.index')])
        <div class="clearfix"></div>
    </footer>
</form>
@endsection
