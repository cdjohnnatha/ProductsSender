<article>
    <div class="table-responsive border-grey-bottom-1px m-b-20">
        @foreach($services as $key => $service)
          <div class="checkbox">
            <label>
              <input type="checkbox" value="{{$service->id}}" data-price="{{$service->price}}">
                {{$service->title.' - '}}
                <small>
                  ({{$service->description}}) -
                  <mark class="md-bg-green-500">
                    {{__('common.titles.price').': '}}
                    <span>{{$service->price}}</span>
                  </mark>
                </small>
            </label>
          </div>
        @endforeach
    </div>
    <div class="row">
      <div class="col-xs-6 col-sm-9 text-right ">
        <span class="block p-b-5 p-t-5">Total:</span>
      </div>
      <div class="col-xs-6 col-sm-1 p-0">
        <span class="block p-b-5 cart-total" id="total_services"></span>
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

       });
    });
  </script>
@endsection
