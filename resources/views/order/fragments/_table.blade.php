
<table id="{{ $table_id }}" class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
    <thead>
    <tr>
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
            <td>{{ $order->uuid }}</td>
            <td><span class="label label-default">{{ $order->orderStatus->message }}</span></td>
            <td>{{Carbon\Carbon::parse($order->updated_at)->format('d/m/Y')}}</td>
            <td>$: {{ $order->total }}</td>
            <td>
                <section id="sweet_alerts_card">
                    <a href="#" class="icon"
                       onclick="window.location='{{ Route("user.orders.show", $order->id) }}'"
                       data-toggle="tooltip"
                       data-placement="top" title="@lang('buttons.titles.show')">
                        <i class="zmdi zmdi-search"></i>
                    </a>
                </section>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>