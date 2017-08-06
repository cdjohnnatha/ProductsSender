@extends('layouts.app')

@section('content')
  <div class="panel-heading">Package</div>
  <div class="panel-body">
    <div class="col-sm-12">
      <div class="col-sm-12">
        <div class="form-group col-sm-12" >
          <div class="form-group col-sm-6" :class="{'has-error': errors.has('warehouse-select') }">
            <label>Warehouse</label>
            <warehouses-select :warehouses="{{$warehouses}}"></warehouses-select>
          </div>
          <div class="form-group col-sm-6" {{ $errors->has('suite') ? ' has-error' : '' }}>
            <label>Suite</label>
            <input name="suite" class="form-control" type="text" required>

            @if ($errors->has('suite'))
              <span class="help-block">
                <strong class="text-danger">{{ $errors->first('suite') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-group col-sm-12">
          <div class="col-sm-6">
            <label>Status</label>
            <status-select :status="{{$status}}"></status-select>
          </div>

          <div class="form-group col-sm-3" {{ $errors->has('weight') ? ' has-error' : '' }}>
            <label>Weight</label>
            <input name="weight" class="form-control" type="number">
            @if ($errors->has('weight'))
              <span class="help-block">
                <strong class="text-danger">{{ $errors->first('weight') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group col-sm-3">
            <label>Weight measure</label>
            <select class="form-control">
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
              <input name="width" class="form-control" type="number" required>
              @if ($errors->has('width'))
                <span class="help-block">
                <strong class="text-danger">{{ $errors->first('width') }}</strong>
              </span>
              @endif
            </div>
            <div class="col-sm-3" {{ $errors->has('height') ? ' has-error' : '' }}>
              <input name="height" class="form-control" type="number" required>
              @if ($errors->has('height'))
                <span class="help-block">
                <strong class="text-danger">{{ $errors->first('height') }}</strong>
              </span>
              @endif
            </div>
            <div class="col-sm-3" {{ $errors->has('depth') ? ' has-error' : '' }}>
              <input name="depth" class="form-control" type="number" required>
              @if ($errors->has('depth'))
                <span class="help-block">
                  <strong class="text-danger">{{ $errors->first('depth') }}</strong>
                </span>
              @endif
            </div>
            <div class="col-sm-3">
              <select class="form-control">
                <option value="cm">cm</option>
                <option value="mm">mm</option>
                <option value="in">in</option>
                <option value="lb">lb</option>
                <option value="m">m</option>
              </select>
            </div>
          </section>

        </div>
        <section class="col-sm-12">
            <label>Upload Pictures</label>
        </section>
        <section class="col-sm-12">
          <div class="col-sm-12">
            <label>Quote</label>
            <textarea class="form-control"></textarea>
          </div>
        </section>

      </div>
    </div>
  </div>
@endsection
