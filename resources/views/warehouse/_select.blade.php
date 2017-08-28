<section id="warehouse_select">
    <select class="select form-control" name="warehouse_id">
      @foreach($warehouses as $warehouse)
        <option value="{{$warehouse->id or old('warehouse_id')}}">
            {{$warehouse->address->label}}
        </option>
      @endforeach
    </select>
    @if ($errors->has('warehouse_id'))
    <span class="help-block">
        <strong class="text-danger" class="alert-danger">
          {{ $errors->first('default_warehouse_id') }}
        </strong>
      </span>
    @endif
</section>
