
<section class="panel-body">
  <div class="col-sm-12">
    <div class="col-sm-12">
      <div class="form-group col-sm-12" >
        <div class="form-group col-sm-6" :class="{'has-error': errors.has('warehouse_id') }">
          <label>Warehouse</label>
          @if(Request::is('*/edit'))
            <warehouses-select :warehouses="{{$warehouses}}"
                               :setwarehouse="{{$package->warehouse_id or old('warehouse_id')}}">
            </warehouses-select>
          @else
            <warehouses-select :warehouses="{{$warehouses}}"
                               :setwarehouse="{{old('warehouse_id') or 1}}">
            </warehouses-select>
          @endif

          @if ($errors->has('warehouse_id'))
            <span class="help-block">
              <strong class="text-danger">{{ $errors->first('warehouse_id') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group col-sm-6" {{ $errors->has('object_owner') ? ' has-error' : '' }}>
          <label>Suite</label>
          <input name="object_owner" class="form-control" type="text" required
                 value="{{$package->object_owner or old('object_owner')}}">

          @if ($errors->has('object_owner'))
            <span class="help-block">
              <strong class="text-danger">{{ $errors->first('object_owner') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group col-sm-12">
        <div class="col-sm-6">
          <label>Status</label>
          @if(Request::is('*/edit'))
            <status-select :status="{{$status}}" :set_status="{{$package->status_id or old('status_id')}}"></status-select>
          @else
            <status-select :status="{{$status}}" :set_status="{{old('status_id') or 1}}"></status-select>
          @endif

        </div>

        <div class="form-group col-sm-3" {{ $errors->has('weight') ? ' has-error' : '' }}>
          <label>Weight</label>
          <input name="weight" class="form-control" type="number" required
                 value="{{$package->weight or old('weight')}}" min="0.01" step="0.01">
          @if ($errors->has('weight'))
            <span class="help-block">
              <strong class="text-danger">{{ $errors->first('weight') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group col-sm-3">
          <label>Weight measure</label>
          <select class="form-control" name="weight_measure">
            <option value="kg">kg</option>
            <option value="g">g</option>
            <option value="lbs">lbs</option>
          </select>
        </div>

      </div>
      <div class="form-group col-sm-12">
        <label class="col-sm-12">Dimensions</label>
        <section>
          <div class="col-sm-3" {{ $errors->has('width') ? ' has-error' : '' }} >
            <label for="width">Width</label>
            <input name="width" class="form-control" type="number" required
                   value="{{$package->width or old('width')}}" min="0.01" step="0.01">
            @if ($errors->has('width'))
              <span class="help-block">
              <strong class="text-danger">{{ $errors->first('width') }}</strong>
            </span>
            @endif
          </div>
          <div class="col-sm-3" {{ $errors->has('height') ? ' has-error' : '' }}>
            <label for="height">Height</label>
            <input name="height" class="form-control" type="number" required
                   value="{{$package->height or old('height')}}" min="0.01" step="0.01">
            @if ($errors->has('height'))
              <span class="help-block">
              <strong class="text-danger">{{ $errors->first('height') }}</strong>
            </span>
            @endif
          </div>
          <div class="col-sm-3" {{ $errors->has('depth') ? ' has-error' : '' }}>
            <label for="height">Depth</label>
            <input name="depth" class="form-control" type="number" required
                   value="{{$package->depth or old('depth')}}" min="0.01" step="0.01">
            @if ($errors->has('depth'))
              <span class="help-block">
                <strong class="text-danger">{{ $errors->first('depth') }}</strong>
              </span>
            @endif
          </div>
          <div class="col-sm-3">
            <label for="unit_measure">Unit Measure</label>
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
          <label>Note</label>
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
          <label>Upload Pictures</label>
          <package-upload-files></package-upload-files>
        </div>
      </section>
    </div>
  </div>
</section>

