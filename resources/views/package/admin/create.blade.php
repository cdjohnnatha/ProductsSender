@extends('layouts.app')

@section('panel_header')
  Packages
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
  <section class="card">
    <section class="tab-content  p-20">
      <section class="tab-pane fadeIn active" id="tab-1">
        <div class="row">
          <header class="card-heading">
            <h2 class="card-title">{{ __('packages.form.title_form') }}</h2>
            <div class="card-search">
              <div id="productsTable_wrapper" class="form-group label-floating is-empty">
                <i class="zmdi zmdi-search search-icon-left"></i>
                <input type="text" class="form-control filter-input" placeholder="Filter Packages..."
                       autocomplete="off">
                <a href="javascript:void(0)" class="close-search" data-card-search="close" data-toggle="tooltip"
                   data-placement="top" title="Close"><i class="zmdi zmdi-close"></i></a>
              </div>
            </div>
          </header>
          @if(Request::is('*/edit'))
            <?php $action = 'admin.packages.update' ?>
              <form action="{{ route($action, $package->id) }}" role="form" method="POST">
              <input name="_method" type="hidden" value="PUT">
          @else
            <?php $action = 'admin.packages.store' ?>
            <form action="{{ route($action) }}" role="form" method="POST">
          @endif
            {{  csrf_field()  }}
            <section class="card-body">
              <section class="row">
                <div
                  class="form-group col-sm-4 label-floating {{ $errors->has('warehouse_id') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
                    <label class="control-label">{{__('warehouse.form.select_warehouse')}}</label>
                    @include('company.warehouse._select', ['tagName' => 'package[company_warehouse_id]', 'tags' => 'package.company_warehouse_id'])
                  </div>
                </div>

                <div class="form-group col-sm-4 label-floating {{ $errors->has('package.client_id') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                    <label class="control-label">{{__('packages.form.suite')}}</label>
                    <input type="text" class="form-control" name="package[client_id]"
                           value="{{$package->client or old('package.client_id')}}">

                    @if ($errors->has('package.client_id'))
                      <span class="help-block">
                        <strong class="text-danger" class="alert-danger">
                          {{ $errors->first('package.client_id') }}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>


                <section class="form-group label-floating {{ $errors->has('package.status_id') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-traffic"></i></span>
                    @include('package._package_status_select', ['tagName' => 'package[package_status_id]', 'tags' => 'package.package_status_id'])
                  </div>
                </section>
              </section>
              <section class="row">
                <section
                  class="form-group col-sm-2 label-floating {{ $errors->has('package.weight') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-ruler"></i></span>
                    <label class="control-label">{{__('packages.form.weight')}}</label>
                    <input type="number" class="form-control" name="package[weight]"
                           value="{{$package->weight or old('package.weight')}}" min="0.01" step="0.01">

                    @if ($errors->has('package.weight'))
                      <span class="help-block">
                        <strong class="text-danger" class="alert-danger">
                          {{ $errors->first('package.weight') }}
                        </strong>
                      </span>
                    @endif
                  </div>
                </section>


                <section class="form-group col-sm-2 label-floating">
                  <label class="control-label">{{__('packages.form.weight_measure')}}</label>
                  <select class="select form-control" name="package[weight_measure]">
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="lbs">lbs</option>
                  </select>
                </section>

                <section
                  class="form-group col-sm-2 label-floating {{ $errors->has('package.width') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-ruler"></i></span>
                    <label class="control-label">{{__('packages.form.width')}}</label>
                    <input type="number" class="form-control" name="package[width]"
                           value="{{$package->width or old('package.form.width')}}" min="0.01" step="0.01">

                    @if ($errors->has('package.width'))
                      <span class="help-block">
                        <strong class="text-danger" class="alert-danger">
                          {{ $errors->first('package.width') }}
                        </strong>
                      </span>
                    @endif
                  </div>
                </section>


                <div
                  class="form-group col-sm-2 label-floating {{ $errors->has('packages.height') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-ruler"></i></span>
                    <label class="control-label">{{__('packages.form.height')}}</label>
                    <input type="number" min="0.01" step="0.01" class="form-control" name="package[height]"
                           value="{{ $package->height or old('packages.height') }}">


                    @if ($errors->has('packages.height'))
                      <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('height') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div
                  class="form-group col-sm-2 label-floating {{ $errors->has('packages.depth') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-ruler"></i></span>
                    <label class="control-label">{{__('packages.form.depth')}}</label>
                    <input type="number" min="0.01" step="0.01" class="form-control" name="package[depth]"
                           value="{{ $package->depth or old('packages.depth') }}">


                    @if ($errors->has('packages.depth'))
                      <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('depth') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div
                  class="form-group col-sm-2 label-floating {{ $errors->has('packages.unit_measure') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <label class="control-label">{{__('packages.form.unit_measure')}}</label>
                    <select class="select form-control" name="package[unit_measure]">
                      <option value="cm" selected>cm</option>
                      <option value="mm">mm</option>
                      <option value="in">in</option>
                      <option value="lb">lb</option>
                      <option value="m">m</option>
                    </select>


                    @if ($errors->has('packages.unit_measure'))
                      <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('unit_measure') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </section>

              <div class="form-group label-floating">
                <div class="input-group col-sm-12">
                  <input type="file" class="form-control" placeholder="File Upload..." multiple
                         name="package_files[]" id="package_files">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-collection-image"></i></span>
                    <label class="control-label">{{__('packages.form.upload_pictures')}}</label>
                    <input type="text" readonly="" class="form-control">
                    <span class="input-group-btn input-group-sm">
                      <button type="button" class="btn btn-primary btn-fab btn-fab-sm">
                        <i class="zmdi zmdi-attachment-alt"></i>
                      </button>
                    </span>
                  </div>
                  @if ($errors->has('packages.package_files'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('package_files') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <section class="form-group label-floating {{ $errors->has('package.quote') ? ' has-error' : '' }}">
                <div class="input-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-comment-text"></i></span>
                  <label class="control-label">{{__('packages.form.quote')}}</label>
                  <textarea class="form-control" rows="2" name="package[quote]"></textarea>

                  @if ($errors->has('package.quote'))
                    <span class="help-block">
                      <strong class="text-danger">{{ $errors->first('package.quote') }}</strong>
                    </span>
                  @endif
                </div>
                    </section>


                  </section>
                  <footer class="card-footer text-right">
                      @include('layouts.formButtons._form_save_edit', ['url' => Route('admin.packages.index')])
                  </footer>
                </form>
        </div>
      </section>
      <section class="tab-pane" id="tab-2">
        {{--@if(Request::is('*/edit'))--}}
        {{--@if(!is_null($package->goods))--}}
        {{--@include('package.incoming._show', ['incomingPackage' => $package->goods])--}}
        {{--@endif--}}
        {{--@elseif(!is_null($incoming))--}}
        {{--@include('package.incoming._show', ['incomingPackage' => $incoming])--}}
        {{--@endif--}}
      </section>
    </section>
  </section>
@endsection