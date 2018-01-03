@extends('layouts.app')

@section('panel_header')
    @lang('company.fees.fees')
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
                        <h2 class="card-title">@lang('company.fees.form')</h2>
                    </header>
                    @if(Request::is('*/edit'))
                        <form action="{{ route('admin.companies.warehouses.fees.update', [$data['companyId'],
                        $data['warehouseId'], $data['feeRule']->id]) }}" role="form" method="POST">
                            <input name="_method" type="hidden" value="PUT">
                    @else
                        <form action="{{ route('admin.companies.warehouses.fees.store', [$data['companyId'],
                        $data['warehouseId']]) }}" role="form" method="POST">
                            @endif
                            {{ csrf_field() }}
                            <section class="card-body">
                                <article>
                                    <section class="row">
                                        <div class="form-group col-sm-8 label-floating {{ $errors->has('title') ? 'has-error' : '' }}">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-receipt"></i></span>
                                                <label class="control-label">@lang('company.fees.title')</label>
                                                <input type="text" class="form-control" name="title" value="{{ $data['feeRule']->title or old('initial_fee') }}">

                                                @if ($errors->has('title'))
                                                    <span class="help-block">
                                                      <strong class="text-danger" class="alert-danger">
                                                        {{ $errors->first('title') }}
                                                          <span class="zmdi zmdi-close form-control-feedback" aria-hidden="true"></span>
                                                      </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-4 label-floating {{ $errors->has('amount') ? 'has-error' : '' }}">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                                                <label class="control-label">@lang('company.fees.amount')</label>
                                                <input type="number" min="0" step="0.01" class="form-control" name="amount" value="{{ $data['feeRule']->amount or old('amount') }}">
                                                @if ($errors->has('amount'))
                                                    <span class="help-block">
                                                      <strong class="text-danger" class="alert-danger">
                                                        {{ $errors->first('amount') }}
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
