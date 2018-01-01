@extends('layouts.app')

@section('panel_header')
    @lang('company.fee_rules.title')
@endsection


@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="content-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <header class="card-heading ">
                        <h2 class="card-title">@lang('company.addons.form')</h2>
                    </header>
                    @if(Request::is('*/edit'))
                        <form action="{{ route('admin.companies.warehouses.fee-rules.update', [$data['companyId'],
                        $data['warehouseId'], $data['warehouseAddon']->id]) }}" role="form" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                    @else
                        <form action="{{ route('admin.companies.warehouses.fee-rules.store', [$data['companyId'],
                        $data['warehouseId']]) }}" role="form" method="POST">
                            @endif
                            {{ csrf_field() }}
                            <section class="card-body">
                                <article>
                                    <section class="row">
                                        <input type="hidden" name="company_warehouse_id" value="{{ $data['warehouseId'] }}">

                                        <div class="form-group col-sm-4 label-floating {{ $errors->has('initial_fee') ? 'has-error' : '' }}">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                                                <label class="control-label">@lang('company.fee_rules.initial_fee')</label>
                                                <input type="number" min="0" step="0.01" class="form-control" name="initial_fee" value="{{ old('initial_fee') }}">

                                                @if ($errors->has('initial_fee'))
                                                    <span class="help-block">
                                                      <strong class="text-danger" class="alert-danger">
                                                        {{ $errors->first('initial_fee') }}
                                                          <span class="zmdi zmdi-close form-control-feedback" aria-hidden="true"></span>
                                                      </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-4 label-floating {{ $errors->has('max_weight_fee') ? 'has-error' : '' }}">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                                                <label class="control-label">@lang('company.fee_rules.max_weight')</label>
                                                <input type="number" min="0" step="0.01" class="form-control" name="max_weight_fee" value="{{ old('max_weight_fee') }}">
                                                @if ($errors->has('max_weight_fee'))
                                                    <span class="help-block">
                                                      <strong class="text-danger" class="alert-danger">
                                                        {{ $errors->first('max_weight_fee') }}
                                                          <span class="zmdi zmdi-close form-control-feedback"
                                                                aria-hidden="true"></span>
                                                      </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-4 label-floating {{ $errors->has('overweight_fee') ? 'has-error' : '' }}">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                                                <label class="control-label">@lang('company.fee_rules.over_weight')</label>
                                                <input type="number" min="0" step="0.01" class="form-control" name="overweight_fee" value="{{ old('overweight_fee') }}">
                                                @if ($errors->has('overweight_fee'))
                                                    <span class="help-block">
                                                      <strong class="text-danger" class="alert-danger">
                                                        {{ $errors->first('overweight_fee') }}
                                                          <span class="zmdi zmdi-close form-control-feedback"
                                                                aria-hidden="true"></span>
                                                      </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>


                                    </section>


                                </article>
                            </section>
                            <footer class="card-footer text-right">
                                @include('layouts.formButtons._form_save_edit', ['url' => Route('admin.companies.warehouses.show', [ $data['companyId'],  $data['warehouseId']])])
                            </footer>
                        </form>
                </div>
            </div>
        </div>
    </section>
@endsection
