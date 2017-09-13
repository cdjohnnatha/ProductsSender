<article id="content_wrapper" class="card-overlay invoice-page" style="padding-top: 0;">
  <div id="content" class="container">
    <div class="row">
      <div class="col-xs-12">
        <div>
          <div class="card-body p-50 p-t-10 invoice">
            <div class="row">
              <div class="col-xs-6">
                <h1><img src="{{asset('/img/logo/holyship.png')}}" alt='logo' style="width: 40%;"/></h1>
              </div>
              <div class="col-xs-6">
                <h3>{{__('common.titles.warehouse')}}</h3>
                <address class="address">
                  {{$incomingPackage->warehouse->address->label}}<br>
                  {{$incomingPackage->warehouse->address->formatted_address}}<br>
                  {{$incomingPackage->warehouse->address->postal_code}}<br>
                  {{__('common.titles.phone').': '.$incomingPackage->warehouse->address->phone}}<br>
                </address>
              </div>
            </div>
            <div class="table-responsive">
              <h3>{{__('common.titles.goods')}}</h3>
              <small><mark class="md-bg-yellow">{{__('packages.goods.short_description_check')}}</mark></small>
              <table class="table">
                <thead>
                <tr>
                  <th>Item#</th>
                  <th>{{__('common.titles.description')}}</th>
                  <th>{{__('payments.titles.quantity')}}</th>
                  <th>{{__('payments.titles.unit_price')}}</th>
                  <th>{{__('payments.titles.total')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($incomingPackage->goodsDeclaration as $key=>$goods)
                  <tr>
                    <th scope="row">{{$key + 1}}</th>
                    <td>{{$goods->description}}</td>
                    <td>{{$goods->quantity}}</td>
                    <td>$ {{$goods->unit_price}}</td>
                    <td>$ {{$goods->total_unit}}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="table-responsive">
              <h3>{{__('common.titles.addon')}}</h3>
              <table class="table">
                <thead>
                <tr>
                  <th>Item#</th>
                  <th>{{__('common.titles.description')}}</th>
                  <th>Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($incomingPackage->addons as $key=>$addon)
                  <tr>
                    <th scope="row">{{$key + 1}}</th>
                    <td>{{$addon->service->title}}
                      <p>{{$addon->service->description}}</p>
                    </td>
                    <td>{{$addon->service->price}}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="invoice-total">
              <div class="row">
                <div class="col-xs-4">

                </div>
                <div class="col-xs-7">
                  {{--<span class="text-right text-gray">{{__('payments.titles.sub_total')}}</span>--}}
                  <span class="text-right text-gray">{{__('payments.titles.discount')}}</span>
                  <span class="text-right m-t-10"><strong>{{__('payments.titles.total')}}</strong></span>
                </div>
                <div class="col-xs-1">
                  {{--<span>$9,700</span>--}}
                  <span>{{$incomingPackage->user->subscription->discounts.' %'}}</span>
                  <span class="total">${{$incomingPackage->total_addons}}</span>
                </div>
              </div>
                @if(auth()->guard('web')->user())
                  <a href="{{route('user.packages.index')}}" class="btn btn-primary btn-round pull-right m-t-20 m-b-20">Ok</a>
                @else
                  <a href="" class="btn btn-info btn-round pull-right m-t-20 m-b-20
                    {{$incomingPackage->registered ? 'disabled' : ''}}">Register Package</a>
                  <a href="{{route('admin.packages.index')}}" class="btn btn-warning btn-round pull-right m-t-20 m-b-20">Cancel</a>
                @endif
            </div>
            @if(auth()->guard('web')->user())
              <footer class="invoice-footer">
                <div class="row">
                  <div class="col-xs-3">
                    <div class="logo">
                      <h2><img src="{{asset('/img/logo/holyship-square.png')}}" alt='logo'/></h2>
                    </div>
                  </div>
                </div>
              </footer>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</article>