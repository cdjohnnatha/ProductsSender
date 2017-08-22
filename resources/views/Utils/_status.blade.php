<section>
  <label class="control-label">{{__('common.titles.status')}}</label>
  <select class="form-control" name="status[status_id]">
    @foreach($status as $item)
      <option value="{{$item->id or old('status.status_id')}}">
        {{$item->status}}
      </option>
    @endforeach
  </select>
</section>
