<section id="warehouse_select">
    <select class="select form-control" name="default_warehouse">
      @foreach($warehouses as $warehouse)
        <option value="{{$warehouse->id or old('default_warehouse')}}">
            {{$warehouse->address['label']}}
        </option>
      @endforeach
    </select>
    @if ($errors->has('default_warehouse'))
    <span class="help-block">
        <strong class="text-danger" class="alert-danger">
          {{ $errors->first('default_warehouse') }}
        </strong>
    </span>
    @endif
</section>
