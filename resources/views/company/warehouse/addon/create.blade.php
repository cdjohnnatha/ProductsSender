@extends('layouts.app')

@section('panel_header')
    {{__('company.addons.title')}}
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
                    <h2 class="card-title">{{__('company.addons.form')}}</h2>
                </header>
                @if(Request::is('*/edit'))
                    <?php $action = 'admin.companies.warehouses.addons.update' ?>
                        <form action="{{route($action, [$companyId, $warehouseId, $warehouseAddon->id])}}" role="form" method="POST">
                        <input name="_method" type="hidden" value="PUT">
                    @else
                        <?php $action = 'admin.companies.warehouses.addons.store'?>
                        <form action="{{route($action, [$companyId, $warehouseId])}}" role="form" method="POST">
                    @endif
                            {{ csrf_field() }}
                            <section class="card-body">
                              <article>
                                <section class="row">
                                  <input type="hidden" name="company_warehouse_id" value="{{$warehouseId}}">

                                  <div class="form-group col-sm-8 label-floating {{ $errors->has('company_addons_id') ? 'has-error' : '' }}">
                                    <select class="select form-control" name="company_addons_id">
                                      @foreach($companyAddons as $addon)
                                        <option value="{{$addon->id or old('company_addons_id')}}">
                                          {{$addon->title}}
                                        </option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('company_addons_id'))
                                      <span class="help-block">
                                        <strong class="text-danger" class="alert-danger">
                                          {{ $errors->first('company_addons_id') }}
                                        </strong>
                                       </span>
                                    @endif
                                  </div>

                                  <div class="form-group col-sm-4 label-floating {{ $errors->has('price') ? 'has-error' : '' }}">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                                      <label class="control-label">{{ __('common.titles.price')}}</label>
                                      <input type="number" min="0" step="0.01" class="form-control" name="price"
                                             value="{{ $warehouseAddon->price or old('price') }}" id="price">

                                      @if ($errors->has('price'))
                                        <span class="help-block">
                                          <strong class="text-danger" class="alert-danger">
                                            {{ $errors->first('price') }}
                                            <span class="zmdi zmdi-close form-control-feedback" aria-hidden="true"></span>
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
