<section>
  <div class="form-group col-sm-12" >
    <section class="form-group col-sm-3" {{ $errors->first('warehouse.storage_time') }} >
      <label>Storage Time</label>
      <input name="warehouse[storage_time]" class="form-control" type="number" required min="0"
             step="1" value="{{$warehouse->storage_time or old('warehouse.storage_time') }}">

      @if ($errors->has('warehouse.storage_time'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('warehouse.storage_time') }}</strong>
          </span>
      @endif
    </section>
    <div class="form-group col-sm-3" {{ $errors->first('warehouse.box_price') }} >
      <label>Box price</label>
      <input name="warehouse[box_price]" class="form-control" type="number" min="0.00" step="0.01"
             value="{{$warehouse->box_price or old('warehouse.box_price') }}">

      @if ($errors->has('warehouse.box_price'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('warehouse.box_price') }}</strong>
          </span>
      @endif
    </div>
  </div>
</section>
