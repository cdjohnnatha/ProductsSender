@extends('layouts.app')

@section('panel_header')
    @lang('order.index.orders')
@endsection


@section('content')
    <section class="card">
        <header class="card-heading">
            <h2 class="card-title">Order UUID: <small>{{ $data['order']->uuid }}</small></h2>
            <h2 class="card-title">Status: <small> {{ $data['order']->orderStatus->message }} </small></h2>
        </header>
        <section class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                @foreach($data['order']->orderPackages as $index => $package)
                    <div class="card">
                        <div class="panel-heading" role="tab" id="heading-{{ $index }}">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $index }}"
                                   aria-expanded="false" aria-controls="collapse-{{ $index }}">
                                    Package #{{ $package->id }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-{{ $index }}" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="heading-{{ $index }}">
                            <div class="panel-body">
                                <article>
                                    <div class="table-responsive border-grey-bottom-1px m-b-20" id="table_checkbox">
                                        <div class="card-body">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Amount $</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Shipment</td>
                                                    <td>{{ $data['order']->orderFowards[$index]->price }}</td>
                                                </tr>
                                                @foreach($package->orderAddons as $addon)
                                                    <tr>
                                                        <td>{{ $addon->companyWarehouseAddon->companyAddons->title }}</td>
                                                        <td>{{ $addon->price }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>Weight Fees</td>
                                                    <td>{{ $package->orderFeeWeightRules->total }}</td>
                                                </tr>
                                                    @foreach($data['order']->orderPackages[$index]->orderPackageFeeRules as $fees)
                                                        <tr>
                                                            <td>{{ $fees->feeRules->title }}</td>
                                                            <td>{{ $fees->price }}</td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                            <input type="hidden" id="package_id" value="{{ $package->id }}">
                                            <div id="price_addons"></div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div id="content" class="container">
                        <div class="row">
                            <div class="pull-right">
                                <div class="col-xs-12">
                                    <span class="text-right m-t-10"><strong>TOTAL:</strong></span>
                                    <span class="total">${{ $data['order']->total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </section>
@endsection