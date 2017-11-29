@extends('layouts.app')

@section('panel_header')
    Warehouses
@endsection


@section('content')

<section class="content-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <header class="card-heading ">
                    <h2 class="card-title">{{__('warehouse.form.main_title')}}</h2>
                </header>
                @if(Request::is('*/edit'))
                    <?php $action = 'admin.company-warehouses.update' ?>
                        <form action="{{route($action, $company_warehouse->id)}}" role="form" method="POST">
                        <input name="_method" type="hidden" value="PUT">
                    @else
                        <?php $action = 'admin.company-warehouses.store' ?>
                        <form action="{{route($action)}}" role="form" method="POST">
                    @endif
                            {{ csrf_field() }}
                            <section class="card-body">
                                @include('company_warehouse._form')
                            </section>
                            <footer class="card-footer text-right">
                                @include('layouts.formButtons._form_save_edit', ['url' => Route('admin.company-warehouses.index')])
                            </footer>
                        </form>
            </div>
        </div>
    </div>
</section>
@endsection
