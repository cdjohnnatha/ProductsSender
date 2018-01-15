@extends('layouts.app')

@section('panel_header')
    @lang('invoice.title')
@endsection


@section('content')
    <section class="card">
        <header class="card-body p-0">
            <div class="tabpanel">
                <ul class="nav nav-tabs nav-tabs-right">
                    <li class="active" role="presentation">
                        <a href="#tab-1" data-toggle="tab" aria-expanded="true">@lang('invoice.index.inbox')</a>
                    </li>
                    <li class="presentation" role="presentation">
                        <a href="#tab-2" data-toggle="tab" aria-expanded="true">@lang('invoice.index.history')</a>
                    </li>
                </ul>
            </div>
        </header>


        <section class="tab-content  p-20">

            <section class="tab-pane fadeIn active" id="tab-1">
                <header class="card-heading">
                    <ul class="card-actions right-top">
                        <li>
                            <button type="button" id="send_packages" class="btn btn-info btn-flat">
                                <i class="zmdi zmdi-money"></i>
                                @lang('order.index.make_payment')
                            </button>
                        </li>
                    </ul>
                </header>
                <h2 class="card-title"> @lang('order.index.orders')</h2>
                <small class="dataTables_info">@lang('order.index.short_title_inbox')</small>

                <div class="row">
                    <div class="card card-data-tables product-table-wrapper">
                        <div class="card-body p-0">
                            <table class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Number</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['invoices'] as $invoice)
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="packages_id[]" value="{{$invoice->id}}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->amount }}</td>
                                            <td>{{ $invoice->invoiceStatus->message }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>


            <section class="tab-pane fadeIn" id="tab-2">
                <h2 class="card-title">@lang('order.index.history')</h2>
                <small class="dataTables_info">@lang('order.index.short_title_history')</small>

                <div class="row">
                    <div class="card card-data-tables product-table-wrapper">
                        <div class="card-body p-0">
                        </div>
                    </div>
                </div>
            </section>
        </section>
        @endsection

        @section('footerJS')
            <script>
                var form = $('#send_merge_packages');
                console.log(form);
                $('#send_packages').click(function(){
                   {{--form.attr('action', '{{ Route('user.packages.sendPackage') }}');--}}
                   form.submit();
                });

                $('#merge_packages').click(function(){
                   alert("test");
                });
            </script>
        @endsection