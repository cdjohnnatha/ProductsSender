<section>
  <div class="form-group col-sm-12" >
    <section class="form-group col-sm-6" {{ $errors->first('name') }} >
      <label>Warehouse name</label>
      <input name="name" class="form-control" type="text" required
             value="{{$warehouse->name or old('name') }}">

      @if ($errors->has('name'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('name') }}</strong>
          </span>
      @endif
    </section>
    <section class="form-group col-sm-3" {{ $errors->first('storage_time') }} >
      <label>Storage Time</label>
      <input name="storage_time" class="form-control" type="number" required
             value="{{$warehouse->storage_time or old('storage_time') }}">

      @if ($errors->has('storage_time'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('storage_time') }}</strong>
          </span>
      @endif
    </section>
    <div class="form-group col-sm-3" {{ $errors->first('box_price') }} >
      <label>Box price</label>
      <input name="box_price" class="form-control" type="number"
             value="{{$warehouse->box_price or old('box_price') }}">

      @if ($errors->has('box_price'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('box_price') }}</strong>
          </span>
      @endif
    </div>
  </div>
</section>
