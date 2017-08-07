@extends('layouts.app')
@section('content')
    <header class="panel-heading">Package</header>
    @if(Request::is('*/edit'))
        <?php $action = 'admin.packages.update' ?>
        <form action="{{route($action, $subscription->id)}}" role="form" method="POST" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="PUT">
    @else
        <?php $action = 'admin.packages.store' ?>
        <form action="{{route($action)}}" role="form" method="POST" enctype="multipart/form-data">
    @endif
        <section class="panel-body">
            {{ csrf_field() }}
            @include('package._form')
        </section>
        <footer class="panel-footer">
            @include('layouts.formButtons._form_save_edit')
            <div class="clearfix"></div>
        </footer>
    </form>
@endsection