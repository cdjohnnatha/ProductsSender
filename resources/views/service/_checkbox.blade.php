<article>
    <div class="table-responsive border-grey-bottom-1px m-b-20">
        @foreach($services as $key => $service)
          <div class="checkbox">
            <label>
              @if($reservation)
                @foreach($reservation->addons as $addon)
                  <input type="checkbox" value="{{$service->id}}" data-price="{{$service->price}}"
                         name="additional_service[{{$key}}][service_id]"
                         {{$addon->addonable_id == $service->id ? 'checked' : ''}}
                         class="addons_check">
                @endforeach
              @else
                <input type="checkbox" class="addons_check" value="{{$service->id}}" data-price="{{$service->price}}" name="additional_service[{{$key}}][service_id]">
                    {{$service->title.' - '}}
              @endif
                <small>
                  ({{$service->description}}) -
                    <span style="color: black;">{{__('common.titles.price').': '}}</span>
                    <span style="color: #388e3c;">+{{$service->price}}</span>
                </small>
            </label>
          </div>
        @endforeach

        <input type="hidden" name="total_addons" id="total_service_input" value="0.00">
    </div>
    @if(auth()->guard('web')->user())
      <div class="row">
        <div class="col-xs-6 col-sm-11 text-right ">
          <span class="block p-b-5 md-text-grey">{{__('payments.titles.sub_total')}}:</span>
          <span class="block p-b-5 md-text-grey">{{__('payments.titles.discounts')}}:</span>
          <span class="block p-b-5 p-t-5">{{__('payments.titles.total')}}:</span>
        </div>
        <div class="col-xs-6 col-sm-1 p-0">
          <span class="block p-b-5" id="services_first_value">0.00</span>
          <span class="block p-b-5" id="discount_services">0.00</span>
          <span class="block p-b-5 cart-total" id="total_services">0.00</span>
        </div>
      </div>
    @endif
</article>

@if(auth()->guard('web')->user())
@section('footerJS')
  <script>
    var total, discounts;
    total = parseInt(0);
    discounts = {{Auth::user()->subscription->discounts}};
    discounts  /= 100;
    $('input[type="checkbox"]').click(function(){
       $(this).each(function(){
          var value = parseFloat($(this).attr('data-price')).toFixed(2);
          console.log(value);
          if($(this).is(":checked")){
            total = parseFloat(total) + parseFloat(value);
            console.log('total: ' + total);
          } else {
            total = parseFloat(total) - parseFloat(value);
          }
          total = parseFloat(total).toFixed(2);
          updateFields(total, discounts);
       });
    });


    function updateTotal() {
        $('.addons_check').each(function(){
            if($(this).is(":checked")){
                var value = parseFloat($(this).attr('data-price')).toFixed(2);
                total = parseFloat(total) + parseFloat(value);
                console.log('total: ' + total);
            }
            total = parseFloat(total).toFixed(2);
            updateFields(total, discounts);
        });
    }

    function updateFields(total, discounts) {
        $('#services_first_value').html(total);
        $('#discount_services').html(parseFloat(total * discounts).toFixed(2));
        $('#total_services').html(total - (total * discounts));
        $('#total_service_input').val(total - (total * discounts));
    }

    updateTotal();
  </script>
@endsection
@endif