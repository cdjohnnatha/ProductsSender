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
                    <?php $action = 'admin.company-addons.update' ?>
                        <form action="{{route($action, $addon->id)}}" role="form" method="POST">
                        <input name="_method" type="hidden" value="PUT">
                    @else
                        <?php $action = 'admin.company-addons.store' ?>
                        <form action="{{route($action)}}" role="form" method="POST">
                    @endif
                            {{ csrf_field() }}
                            <section class="card-body">
                                <article>
                                    <section class="row">
                                        <div class="form-group col-sm-6 label-floating {{ $errors->has('addon.title') ? ' has-error' : '' }}">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                                <label class="control-label">{{__('company.company_addons.form_title')}}</label>
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

                                        <div class="form-group col-sm-6">
                                            @include('company._select', ['fieldName' => 'addon[company_id]'])
                                        </div>
                                    </section>
                                </article>
                            </section>
                            <footer class="card-footer text-right">
                                @include('layouts.formButtons._form_save_edit', ['url' => Route('admin.company-addons.index')])
                            </footer>
                        </form>
            </div>
        </div>
    </div>
</section>
@endsection
