
<section id="address_select">
  <select class="select form-control" name="address_id">
    @foreach($addresses as $address)
      <option value="{{$address->id or old('address_id')}}">
        {{$address->label}}
        @if($address->default_address)
          <span></span>
        @endif
      </option>
    @endforeach
  </select>
</section>