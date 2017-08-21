<article>
  <section class="row">
    <div class="form-group col-sm-6 {{ $errors->has('default_warehouse_id') ? ' has-error has-feedback is-empty' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
        @include('warehouse._select')
      </div>
    </div>
    <div class="input-group col-sm-6 {{ $errors->has('package.object_owner') ? ' has-error' : '' }}">
      <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
      <input type="text" class="form-control" placeholder="Suite" name="package[object_owner]"
             value="{{$package->object_owner or old('object_owner')}}">

      @if ($errors->has('package.object_owner'))
        <span class="help-block">
          <strong class="text-danger" class="alert-danger">
            {{ $errors->first('package.object_owner') }}
          </strong>
        </span>
      @endif
    </div>
  </section>

  <section class="form-group {{ $errors->has('package.status_id') ? ' has-error' : '' }}">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-traffic"></i></span>
      @if(Request::is('*/edit'))
        <status-select :status="{{$status}}" set_status="{{$package->status_id or old('package.status_id')}}"></status-select>
      @else
        <status-select :status="{{$status}}" :set_status="{{$package->status_id or json_encode(old('status.status_id'))}}"></status-select>
      @endif

    </div>
  </section>


  <section class="row">
    <section class="form-group col-sm-6">
      <div class="input-group {{ $errors->has('package.weight') ? ' has-error' : '' }}">
        <span class="input-group-addon"><i class="zmdi zmdi-ruler"></i></span>
        <input type="number" class="form-control" placeholder="{{__('packages.form.weight')}}" name="package[weight]"
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


    <section class="form-group col-sm-6">
      <select class="select form-control" name="package[weight_measure]">
        <option value="kg">kg</option>
        <option value="g">g</option>
        <option value="lbs">lbs</option>
      </select>
    </section>

  </section>

  <section class="row">
    <section class="form-group col-sm-3">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-ruler"></i></span>
        <input type="number" class="form-control" placeholder="{{__('packages.form.width')}}" name="package[width]"
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


    <div class="form-group col-sm-3 {{ $errors->has('packages.height') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-ruler"></i></span>
        <input type="number" min="0.01" step="0.01" class="form-control"
               placeholder="{{__('packages.form.height')}}" name="package[height]"
               value="{{ $package->height or old('packages.height') }}">


        @if ($errors->has('packages.height'))
          <span class="help-block">
              <strong class="text-danger">{{ $errors->first('height') }}</strong>
            </span>
        @endif
      </div>
    </div>

    <div class="form-group col-sm-3 {{ $errors->has('packages.depth') ? ' has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-ruler"></i></span>
        <input type="number" min="0.01" step="0.01" class="form-control"
               placeholder="{{__('packages.form.height')}}" name="package[depth]"
               value="{{ $package->depth or old('packages.depth') }}">


        @if ($errors->has('packages.depth'))
          <span class="help-block">
              <strong class="text-danger">{{ $errors->first('depth') }}</strong>
            </span>
        @endif
      </div>
    </div>

    <div class="form-group col-sm-3 {{ $errors->has('packages.unit_measure') ? ' has-error' : '' }}">
      <div class="input-group">
        <select class="form-control" name="package[unit_measure]">
          <option value="cm" selected>cm</option>
          <option value="mm">mm</option>
          <option value="in">in</option>
          <option value="lb">lb</option>
          <option value="m">m</option>
        </select>


        @if ($errors->has('packages.depth'))
          <span class="help-block">
              <strong class="text-danger">{{ $errors->first('depth') }}</strong>
            </span>
        @endif
      </div>
    </div>
  </section>
  <div class="form-group is-empty">
    <div class="input-group col-sm-12">
      <input type="file" class="form-control" placeholder="File Upload..." multiple name="package_files[]">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-collection-image"></i></span>
        <input type="text" readonly="" class="form-control" placeholder="{{__('packages.form.upload_pictures')}}">
        <span class="input-group-btn input-group-sm">
          <button type="button" class="btn btn-primary btn-fab btn-fab-sm">
            <i class="zmdi zmdi-attachment-alt"></i>
          </button>
        </span>
      </div>
    </div>
  </div>

  <section class="form-group {{ $errors->has('package.status_id') ? ' has-error' : '' }}">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-comment-text"></i></span>
      <textarea class="form-control" rows="2" name="package[quote]" placeholder="{{__('packages.form.quote')}}"></textarea>
    </div>
  </section>

</article>

