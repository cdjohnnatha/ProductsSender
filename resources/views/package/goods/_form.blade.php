<article>
  <section class="row">
    {{--<div class="form-group col-sm-4 label-floating {{ $errors->has('warehouse_id') ? ' has-error' : '' }}">--}}
      {{--<div class="input-group">--}}
        {{--<span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>--}}
        {{--<label class="control-label">{{__('warehouse.form.select_warehouse')}}</label>--}}
        {{--@include('company_warehouse._select')--}}
      {{--</div>--}}
    {{--</div>--}}

    <div class="form-group col-sm-4 label-floating {{ $errors->has('package.object_owner') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <label class="control-label">{{__('packages.form.suite')}}</label>
        <input type="text" class="form-control" name="package[object_owner]" value="{{$package->object_owner or old('object_owner')}}">

        @if ($errors->has('package.object_owner'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('package.object_owner') }}
            </strong>
          </span>
        @endif
      </div>
    </div>


    {{--<section class="form-group label-floating {{ $errors->has('package.status_id') ? ' has-error' : '' }}">--}}
      {{--<div class="input-group">--}}
        {{--<span class="input-group-addon"><i class="zmdi zmdi-traffic"></i></span>--}}
        {{--@include('utils._status')--}}
      {{--</div>--}}
    {{--</section>--}}
  </section>
  <section class="row">
    <section class="form-group col-sm-2 label-floating {{ $errors->has('package.weight') ? ' has-error' : '' }}">
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

    <section class="form-group col-sm-2 label-floating {{ $errors->has('package.width') ? ' has-error' : '' }}">
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


    <div class="form-group col-sm-2 label-floating {{ $errors->has('packages.height') ? ' has-error' : '' }}">
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

    <div class="form-group col-sm-2 label-floating {{ $errors->has('packages.depth') ? ' has-error' : '' }}">
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

    <div class="form-group col-sm-2 label-floating {{ $errors->has('packages.unit_measure') ? ' has-error' : '' }}">
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
      <input type="file" class="form-control" placeholder="File Upload..." multiple name="package_files[]" id="package_files">
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

</article>

