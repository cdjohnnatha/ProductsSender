@extends('layouts.app')

@section('content')

<section class="content-body">
    <div class="row">
        <div class="col-sm-offset-2 col-xs-12 col-sm-8">
            <div class="card">
                <header class="card-heading ">
                    <h2 class="card-title">Inputs with icon prefixes</h2>
                    <ul class="card-actions icons right-top">
                        <li>
                            <a href="javascript:void(0)" data-toggle-view="code">
                                <i class="zmdi zmdi-code"></i>
                            </a>
                        </li>
                    </ul>
                </header>
                <div class="card-body">
                    <div class="">
                        <div class="input-group col-sm-6">
                            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                            <input type="text" class="form-control" placeholder="Name">

                            <input type="text" class="form-control" placeholder="Surname">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                            <input type="email" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
                            <input type="text" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
                            <input type="text" class="form-control" placeholder="country">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-pin"></i></span>
                            <input type="text" class="form-control" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary btn-flat ">Cancel</button>
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</section>


















<header class="panel-heading">Admin</header>
@if(Request::is('*/edit'))
    <?php $action = 'admin.update' ?>
    <form action="{{route($action, $admin->id)}}" role="form" method="POST">
        <input name="_method" type="hidden" value="PUT">
@else
    <?php $action = 'admin.store' ?>
        <form action="{{route($action)}}" role="form" method="POST">
@endif






















    <section class="panel-body">

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
