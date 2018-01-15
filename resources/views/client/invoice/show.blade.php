@extends('layouts.app')


@section('content')
    <article id="content_wrapper" class="card-overlay invoice-page" style="padding-top: 0;">
        <div id="content" class="container">
            <div class="col-xs-12">
                <div class="row">
                    <div class="card">
                        <header class="card-heading">
                            <h2 class="card-title">@lang('invoice.show.invoice_title')
                                No. {{ $data['invoice']->id }}</h2>
                            <small class="">{{ $data['invoice']->created_at }}</small>
                            <ul class="card-actions icons right-top">
                                <li class="dropdown">
                                    <a href="javascript:void(0)" data-toggle="dropdown">
                                        <i class="zmdi zmdi-more-vert"></i>
                                    </a>
                                    <ul class="dropdown-menu btn-primary dropdown-menu-right">
                                        <li>
                                            <a href="javascript:void(0)"><i class="zmdi zmdi-email"></i>
                                                <span class="p-l-5">Email Invoice</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" onclick="javascript:window.print();"><i
                                                        class="zmdi zmdi-print p-r-5"></i> <span
                                                        class="p-l-5">Print Invoice</span></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"><i class="mdi mdi-file-pdf"></i> <span
                                                        class="p-l-5">Download PDF</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </header>
                        <div class="card-body p-50 p-t-10 invoice">
                            <h2><img src="{{asset('/img/logo/holyship.png')}}" alt='logo' style="width: 10%;"/>
                                Holyship
                            </h2>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h3>@lang('invoice.show.invoice_from')</h3>
                                    <address class="address">
                                        {{ $data['invoice']->invoiceOrder()->first()->orderPackages->first()->package->companyWarehouse->name }}
                                        <br>
                                        {{ $data['invoice']->invoiceOrder()->first()->orderPackages->first()->package->companyWarehouse->address->formatted_address }}
                                        <br>
                                        Phone:
                                        @foreach($data['invoice']->invoiceOrder()->first()->orderPackages->first()->package->companyWarehouse->phones as $phone)
                                            {{ $phone->number . ' / ' }}
                                        @endforeach
                                        <br>
                                    </address>
                                </div>
                                <div class="col-xs-6">
                                    <h3>@lang('invoice.show.invoice_to')</h3>
                                    <address class="address">
                                        {{ $data['invoice']->invoiceOrder()->first()->orderFowards()->first()->address->label }}
                                        <br>
                                        {{ $data['invoice']->invoiceOrder()->first()->orderFowards()->first()->address->formatted_address }}
                                        <br>
                                        Phone: @foreach($data['invoice']->invoiceOrder()->first()->client->phones as $phone)
                                            {{ $phone->number . ' / ' }}
                                        @endforeach<br>
                                    </address>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Item#</th>
                                        <th>Description</th>
                                        <th>QTY</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['invoice']->invoiceOrder()->first()->orderPackages as $index => $orderPackages)
                                            @foreach($orderPackages->orderAddons as $addons)
                                                <tr>
                                                    <th scope="row">{{ $orderPackages->package->id }}</th>
                                                    <td>
                                                        {{ $addons->companyWarehouseAddon->companyAddons->title }}
                                                    </td>
                                                    <td>1</td>
                                                    <td>$ {{ $addons->price }}</td>
                                                    <td>$ {{ $addons->price }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>{{ $data['invoice']->invoiceOrder()->first()->orderFowards[$index]->package_id }}</td>
                                                <td>Shipment</td>
                                                <td>1</td>
                                                <td>$ {{ $data['invoice']->invoiceOrder()->first()->orderFowards[$index]->price }}</td>
                                                <td>$ {{ $data['invoice']->invoiceOrder()->first()->orderFowards[$index]->price }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $orderPackages->package->id }}</td>
                                                <td>Weight fees</td>
                                                <td>1</td>
                                                <td>$ {{ $orderPackages->orderFeeWeightRules->total }}</td>
                                                <td>$ {{ $orderPackages->orderFeeWeightRules->total }}</td>
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
                                        <span class="text-right m-t-10"><strong>TOTAL</strong></span>
                                    </div>
                                    <div class="col-xs-1">
                                        <span class="total">${{ $data['invoice']->amount }}</span>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-round pull-right m-t-20 m-b-20">Make a Payment
                                </button>
                            </div>
                            <footer class="invoice-footer">
                                <div class="row">
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection


@section('footerJS')
    <script>
        $('#package_shipment').removeClass('active');
        $('#package_confirmation').addClass('active');
    </script>
@endsection