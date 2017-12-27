<form action="{{ Route('user.packages.processPackageWizard') }}" id="send_merge_packages" method="POST" role="form">
    {{ csrf_field() }}
    <table id="{{ $table_id }}" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th class="col-sm-1" data-orderable="false"></th>
            <th class="col-sm-2" data-orderable="false">@lang('order.table_fragment.uuid')</th>
            <th class="col-sm-2">@lang('order.table_fragment.status')</th>
            <th>@lang('order.table_fragment.updated_at')</th>
            <th data-orderable="false">@lang('order.table_fragment.amount')</th>
            <th data-orderable="false" class="col-xs-2">
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $order)
            <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="orders_id[]" value="{{ $order->id }}"
                                   order_id="{{ $order->id }}">
                        </label>
                    </div>
                </td>
                <td>{{ $order->uuid }}</td>
                <td><span class="label label-default">{{ $order->orderStatus->message }}</span></td>
                <td>{{Carbon\Carbon::parse($order->updated_at)->format('d/m/Y')}}</td>
                <td>$: {{ $order->total }}</td>
                <td>


                    <section id="sweet_alerts_card">
                        {{--@if($package->goodsDeclaration)--}}
                            {{--<a href="#" class="icon"--}}
                               {{--onclick="window.location='{{Route("user.packages.show", $package->id)}}'"--}}
                               {{--data-toggle="tooltip"--}}
                               {{--data-placement="top" title="@lang('buttons.titles.show')">--}}
                                {{--<i class="zmdi zmdi-search"></i>--}}
                            {{--</a>--}}

                            {{--<a href="" class="icon alerting-delete deletePackage" id="{{$package->id}}"--}}
                               {{--data-toggle="tooltip" data-placement="top" title="@lang('buttons.titles.delete')">--}}
                                {{--<i class="zmdi zmdi-delete"></i>--}}
                            {{--</a>--}}
                        {{--@else--}}
                            {{--<a href="#" onclick="window.location='{{Route('user.goods.create', $package->id)}}'" class="icon" data-placement="top" title="@lang('buttons.titles.required_custom_clearance')}}" data-toggle="tooltip">--}}
                            {{--<i class="zmdi zmdi-assignment"></i>--}}
                            {{--</a>--}}
                        {{--@endif--}}

                    </section>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</form>
<form action="/" method="POST" role="form" id="delete-form">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>