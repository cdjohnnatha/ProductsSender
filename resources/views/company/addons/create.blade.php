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
                </header>
                @if(Request::is('*/edit'))
                    <?php $action = 'admin.companies.addons.update' ?>
                        <form action="{{route($action, [$companyId, $addon->id])}}" role="form" method="POST">
                        <input name="_method" type="hidden" value="PUT">
                    @else
                        <?php $action = 'admin.companies.addons.store' ?>
                        <form action="{{route($action, $companyId)}}" role="form" method="POST">
                    @endif
                            {{ csrf_field() }}
                            <section class="card-body">
                                <article>
                                    <input type="hidden" name="addon[company_id]" value="{{$companyId}}">
                                    <section class="row">
                                        <div class="form-group col-sm-12 label-floating {{ $errors->has('addon.title') ? ' has-error' : '' }}">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                                <label class="control-label">{{__('company.addons.form_title')}}</label>
                                                <input type="text" name="addon[title]" class="form-control"
                                                       value="{{ $addon->title or old('addon.title') }}">

                                                @if ($errors->has('addon.title'))
                                                    <span class="help-block">
                                                        <strong class="text-danger" class="alert-danger">
                                                          {{ $errors->first('addon.title') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </section>
                                </article>
                            </section>
                            <footer class="card-footer text-right">
                                @include('layouts.formButtons._form_save_edit', ['url' => Route('admin.companies.show', $companyId)])
                            </footer>
                        </form>
            </div>
        </div>
    </div>
</section>
@endsection
