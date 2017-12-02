<section>
  <label class="control-label">{{__('common.titles.status')}}</label>
  <select class="select form-control" name="{{ $tagName }}">
    @foreach($packageStatus as $item)
      <option value="{{$item->id or old($tag)}}">
        {{$item->message}}
      </option>
    @endforeach
  </select>
</section>
