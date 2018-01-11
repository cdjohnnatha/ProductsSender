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
                @endforeach
            </div>
        </section>
    </section>
@endsection