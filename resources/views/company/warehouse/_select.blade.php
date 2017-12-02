<section id="warehouse_select">
    <select class="select form-control" name="{{ $tagName }}">
      @foreach($warehouses as $warehouse)
        <option value="{{$warehouse->id or old($tags)}}">
            {{ $warehouse->name }}
        </option>
      @endforeach
    </select>
    @if ($errors->has($tags))
    <span class="help-block">
        <strong class="text-danger" class="alert-danger">
          {{ $errors->first($tags) }}
        </strong>
    </span>
    @endif
</section>
