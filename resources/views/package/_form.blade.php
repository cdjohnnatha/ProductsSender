<article>
  <section class="row">
    <div class="form-group col-sm-6 {{ $errors->has('default_warehouse_id') ? ' has-error has-feedback is-empty' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
        @include('warehouse._select');
      </div>
    </div>
    <div class="form-group col-sm-6 {{ $errors->has('package.object_owner') ? ' has-error' : '' }}">
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

  <section class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
      @if(Request::is('*/edit'))
        <status-select :status="{{$status}}" :set_status="{{$package->status_id or old('status_id')}}"></status-select>
      @else
        <status-select :status="{{$status}}" :set_status="{{old('status_id') or 1}}"></status-select>
      @endif
    </div>
  </section>

  <section class="form-group {{ $errors->has('package.weight') ? ' has-error' : '' }}">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-phone"></i></span>
      <input type="number" class="form-control" placeholder="Weight" name="package[wieght]"
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

  <section class="form-group">
    <div class="input-group">
      <span class="input-group-addon"><i class="zmdi zmdi-store"></i></span>
      @include('warehouse._select')
    </div>
  </section>

  <section class="row">
    <div class="form-group col-sm-6 {{ $errors->has('password') ? 'has-error' : '' }}">
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
        <input type="text" class="form-control" placeholder="Password" name="password"
               value="{{ old('password') }}">


        @if ($errors->has('password'))
          <span class="help-block">
            <strong class="text-danger" class="alert-danger">
              {{ $errors->first('password') }}
            </strong>
          </span>
          <span class="zmdi zmdi-close form-control-feedback"></span>
        @endif
      </div>
    </div>

    <div class="form-group col-sm-6 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
      <input type="text" class="form-control" placeholder="Confirm Password">
    </div>
  </section>
</article>







        <div class="form-group col-sm-3" {{ $errors->has('weight') ? ' has-error' : '' }}>
          <label>{{__('packages.form.weight')}}</label>
          <input name="weight" class="form-control" type="number" required

          @if ($errors->has('weight'))
            <span class="help-block">
              <strong class="text-danger">{{ $errors->first('weight') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group col-sm-3">
          <label>{{__('packages.form.weight_measure')}}</label>
          <select class="form-control" name="weight_measure">
            <option value="kg">kg</option>
            <option value="g">g</option>
            <option value="lbs">lbs</option>
          </select>
        </div>

      </div>
      <div class="form-group col-sm-12">
        <label class="col-sm-12">{{__('packages.form.dimensions')}}</label>
        <section>
          <div class="col-sm-3" {{ $errors->has('width') ? ' has-error' : '' }} >
            <label for="width">{{__('packages.form.width')}}</label>
            <input name="width" class="form-control" type="number" required
                   value="{{$package->width or old('width')}}" min="0.01" step="0.01">
            @if ($errors->has('width'))
              <span class="help-block">
              <strong class="text-danger">{{ $errors->first('width') }}</strong>
            </span>
            @endif
          </div>
          <div class="col-sm-3" {{ $errors->has('height') ? ' has-error' : '' }}>
            <label for="height">{{__('packages.form.height')}}</label>
            <input name="height" class="form-control" type="number" required
                   value="{{$package->height or old('height')}}" min="0.01" step="0.01">
            @if ($errors->has('height'))
              <span class="help-block">
              <strong class="text-danger">{{ $errors->first('height') }}</strong>
            </span>
            @endif
          </div>
          <div class="col-sm-3" {{ $errors->has('depth') ? ' has-error' : '' }}>
            <label for="height">{{__('packages.form.depth')}}</label>
            <input name="depth" class="form-control" type="number" required
                   value="{{$package->depth or old('depth')}}" min="0.01" step="0.01">
            @if ($errors->has('depth'))
              <span class="help-block">
                <strong class="text-danger">{{ $errors->first('depth') }}</strong>
              </span>
            @endif
          </div>
          <div class="col-sm-3">
            <label for="unit_measure">{{__('packages.form.unit_measure')}}</label>
            <select class="form-control" name="unit_measure">
              <option value="cm" selected>cm</option>
              <option value="mm">mm</option>
              <option value="in">in</option>
              <option value="lb">lb</option>
              <option value="m">m</option>
            </select>
          </div>
        </section>

      </div>
      <section class="col-sm-12">
        <div class="col-sm-12" {{ $errors->has('note') ? ' has-error' : '' }}>
          <label>{{__('packages.form.note')}}</label>
          <textarea class="form-control" name="note">{{$package->note or old('note')}}</textarea>

          @if ($errors->has('note'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('note') }}</strong>
              </span>
          @endif
        </div>
      </section>

      <section class="col-sm-12">
        <div class="col-sm-12">
          <label>{{__('packages.form.upload_pictures')}}</label>
          <package-upload-files></package-upload-files>
        </div>
      </section>
    </div>
  </div>
</section>

