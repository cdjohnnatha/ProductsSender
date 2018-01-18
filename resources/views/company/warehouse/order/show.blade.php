@extends('layouts.app')

@section('panel_header')
    @lang('order.index.orders')
@endsection


@section('content')
    <section class="card">
        <form action="{{ route('admin.companies.warehouses.orders.update', [ $data['companyId'], $data['warehouseId'], $data['order']->id ]) }}" role="form" method="POST">

            <header class="card-heading">
                <h2 class="card-title">UUID: {{ $data['order']->uuid }} </h2>
                <table class="table">
                    <thead>
                        <th>@lang('order.index.title')</th>
                        <th>@lang('order.index.status')</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>@lang('order.index.order')</td>
                            <td class="col-xs-6">
                                <div class="form-group" style="margin: 0;">
                                    <select class="select form-control" name="order_status_id">
                                        @foreach($data['orderStatus'] as $status)
                                            <option value="{{ $status->id }}" {{ $status->id == $data['order']->orderStatus->id ? 'selected' : ''}}>
                                                {{ $status->message }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('order.table_fragment.invoice_status')</td>
                            <td>{{ $data['order']->invoiceOrder->first()->invoiceStatus->message }}</td>
                        </tr>
                    </tbody>
                </table>
            </header>
            <section class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default ">
                    @foreach($data['order']->orderPackages as $index => $package)
                        <div>
                            <div class="panel-heading" role="tab" id="heading-{{ $index }}">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapse-{{ $index }}"
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
                                                <section class="form-group">
                                                    <label for="track_number">Track Number</label>
                                                    <input type="text" class="form-control" name="order_fowards[{{ $index }}][track_number]" value="{{ $data['order']->orderFowards[$index]->track_number }}">
                                                    <input type="hidden" name="order_fowards[{{ $index }}][package_id]" value="{{ $package->id }}">
                                                </section>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <footer class="card-footer">
                <section class="row">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <button class="btn btn-green pull-right" type="submit"> @lang('buttons.titles.update') </button>
                </section>
            </footer>
        </form>
    </section>
@endsection