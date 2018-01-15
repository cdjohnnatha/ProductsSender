@extends('layouts.app')

@section('panel_header')
    @lang('order.index.orders')
@endsection


@section('content')
    <section class="card">
        <section class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                @foreach($data['order']->orderPackages as $index => $package)
                    @include('client.order.fragments._collapsable', [
                    'data' => $package,
                    'index' => $index,
                    'order_fowards' => $data['order']->orderFowards[$index],
                    'order_addons' => $package->orderAddons])
                    <h4>
                        Weight Fees
                    </h4>
                    <p>
                        {{ "total: " . $package->orderFeeWeightRules->total }}
                        {{ "overweight: " . $package->orderFeeWeightRules->overweight }}
                    </p>

                @endforeach
                <h4>Fees</h4>
                @foreach($data['order']->orderFeeRules as $fees)
                    <p>
                        {{ $fees->feeRules->title . ' - price :' . $fees->price}}
                    </p>
                @endforeach
            </div>
        </section>
    </section>
@endsection