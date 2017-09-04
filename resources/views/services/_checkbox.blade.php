<article>
    <div class="table-responsive border-grey-bottom-1px m-b-20">
        @foreach($services as $key => $service)
          <div class="checkbox">
            <label>
              <input type="checkbox" value="{{$service->id}}" data-price="{{$service->price}}" name="additional_service[{{$key}}][offered_services_id]">
                {{$service->title.' - '}}
                <small>
                  ({{$service->description}}) -
                    <span style="color: black;">{{__('common.titles.price').': '}}</span>
                    <span style="color: #388e3c;">+{{$service->price}}</span>
                </small>
            </label>
          </div>
        @endforeach
    </div>
    <div class="row">
      <div class="col-xs-6 col-sm-9 text-right ">
        <span class="block p-b-5 p-t-5">Discount:</span>
        <span class="block p-b-5 p-t-5">Total:</span>
      </div>
      <div class="col-xs-6 col-sm-1 p-0">
        <span class="block p-b-5 cart-total" id="total_services"></span>
        <span class="block p-b-5 cart-total" id="discount_services"></span>
        <input type="hidden" name="total_goods" id="total_service_input">
        <input type="hidden" name="total_goods" id="discount">
      </div>
    </div>
</article>

@section('footerJS')
  <script>
    var total;
    total = parseInt(0);

    $('input[type="checkbox"]').click(function(){
       $(this).each(function(){
          var labelTotal = $('#total_services');
          var value = parseFloat($(this).attr('data-price')).toFixed(2);
          console.log(value);
          if($(this).is(":checked")){
            total = parseFloat(total) + parseFloat(value);
            console.log('total: ' + total);
          } else {
            total = parseFloat(total) - parseFloat(value);
          }
          total = parseFloat(total).toFixed(2);
          labelTotal.html(total);
          $('#total_service_input').val(total);

       });
    });
  </script>
@endsection
