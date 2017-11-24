@extends('layouts.app')

@section('panel_header')
    {{__('common.titles.companies')}}
@endsection


@section('content')

<section class="content-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <header class="card-heading ">
                    <h2 class="card-title">{{__('company.titles.form')}}</h2>
                    <ul class="card-actions icons right-top">
                        <li>
                            <a href="javascript:void(0)" data-toggle-view="code">
                                <i class="zmdi zmdi-code"></i>
                            </a>
                        </li>
                    </ul>
                </header>
                @if(Request::is('*/edit'))
                    <?php $action = 'admin.companies.update' ?>
                        <form action="{{route($action, $company->id)}}" role="form" method="POST">
                        <input name="_method" type="hidden" value="PUT">
                    @else
                        <?php $action = 'admin.companies.store' ?>
                        <form action="{{route($action)}}" role="form" method="POST">
                    @endif
                            {{ csrf_field() }}
                            <section class="card-body">
                                @include('company._form')
                            </section>
                            <footer class="card-footer text-right">
                                @include('layouts.formButtons._form_save_edit', ['url' => Route('admin.companies.index')])
                            </footer>
                        </form>
            </div>
        </div>
    </div>
</section>
@endsection
