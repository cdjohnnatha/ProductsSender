<article id="content_wrapper" class="card-overlay invoice-page" style="padding-top: 0;">
    <div id="content" class="container">
        <div class="row">
            <div class="{{ Route::is('user.single_package.create.selected ') ? 'col-xs-12' : 'col-xs-10' }}">
                <div>
                    <div class="card-body p-50 p-t-10 invoice">
                        <div class="row">
                            <div class="col-xs-6">
                                <h1><img src="{{asset('/img/logo/holyship.png')}}" alt='logo' style="width: 40%;"/></h1>
                            </div>
                            <div class="col-xs-6">
                                <h3>@lang('packages.custom_clearance.show.address_from')</h3>

                                <small>(@lang('packages.custom_clearance.show.warehouse'))</small>
                                <address class="address">
                                    {{ $package->companyWarehouse->name }}<br>
                                    {{ $package->companyWarehouse->address->formatted_address }}<br>
                                    {{ $package->companyWarehouse->address->postal_code }}<br>
                                    {{ __('packages.custom_clearance.show.phone').': ' }}<br>
                                    @foreach($package->companyWarehouse->phones as $phones)
                                        {{ $phones->number . ' / ' }}
                                    @endforeach
                                </address>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <h3>@lang('packages.custom_clearance.show.goods')</h3>
                            <small>
                                <mark class="md-bg-yellow">@lang('packages.goods.short_description_check')</mark>
                            </small>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>@lang('packages.custom_clearance.show.item')#</th>
                                    <th>@lang('packages.custom_clearance.show.description')</th>
                                    <th>@lang('packages.custom_clearance.show.quantity')</th>
                                    <th>@lang('packages.custom_clearance.show.unit_price')</th>
                                    <th>@lang('packages.custom_clearance.show.total')</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <th>@lang('packages.custom_clearance.show.total')</th>
                                    <td>{{ $package->total_goods }}</td>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($package->goodsDeclaration as $key => $goods)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $goods->description }}</td>
                                        <td>{{ $goods->quantity }}</td>
                                        <td>$ {{ $goods->unit_price }}</td>
                                        <td>$ {{ $goods->total_unit }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <h3>@lang('packages.custom_clearance.show.addons')</h3>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>@lang('packages.custom_clearance.show.item')#</th>
                                    <th>@lang('packages.custom_clearance.show.description')</th>
                                    <th>@lang('packages.custom_clearance.show.price')</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--@foreach($package->addons as $key=>$addon)--}}
                                {{--<tr>--}}
                                {{--<th scope="row">{{$key + 1}}</th>--}}
                                {{--<td>{{$addon->service->title}}--}}
                                {{--<p>{{$addon->service->description}}</p>--}}
                                {{--</td>--}}
                                {{--<td>{{$addon->service->price}}</td>--}}
                                {{--</tr>--}}
                                {{--@endforeach--}}
                                </tbody>
                            </table>
                        </div>
                        <div class="invoice-total">
                            <div class="row">
                                <div class="col-xs-4">

                                </div>
                                <div class="col-xs-7">
                                    <span class="text-right text-gray">@lang('packages.custom_clearance.show.sub_total')</span>
                                    <span class="text-right text-gray">@lang('packages.custom_clearance.show.discount')</span>
                                    <span class="text-right m-t-10"><strong>@lang('packages.custom_clearance.show.total')</strong></span>
                                </div>
                                <div class="col-xs-1">
                                    {{--<span>$9,700</span>--}}
                                    {{--                  <span class="total">${{$incomingPackage->total_addons}}</span>--}}
                                </div>
                            </div>
                            @if(auth()->guard('web')->user())
                                @if(Route::is('*/packages/*'))
                                    <a href="{{route('user.packages.index')}}"
                                       class="btn btn-primary btn-round pull-right m-t-20 m-b-20">Ok</a>
                                @endif
                            @else
                                <a href="" class="btn btn-info btn-round pull-right m-t-20 m-b-20
                    {{--{{$incomingPackage->registered ? 'disabled' : ''}}">Register Package</a>--}}
                                        <a href="{{route('admin.packages.index')}}" class="btn btn-warning btn-round
                                pull-right m-t-20 m-b-20">Cancel</a>
                            @endif
                        </div>
                        {{--@if(auth()->guard('web')->user() && Route::is('*/packages/*'))--}}
                        {{--<footer class="invoice-footer">--}}
                        {{--<div class="row">--}}
                        {{--<div class="col-xs-3">--}}
                        {{--<div class="logo">--}}
                        {{--<h2><img src="{{asset('/img/logo/holyship-square.png')}}" alt='logo'/></h2>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</footer>--}}
                        {{--@endif--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>