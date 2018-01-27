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
            <form action="{{ route('user.invoices.store') }}" method="POST" role="form">
                {{ csrf_field() }}
                <header class="card-heading">
                    <ul class="card-actions right-top">
                        <li>
                            <button type="submit" id="make_payment" class="btn btn-info btn-flat" disabled>
                                <i class="zmdi zmdi-money"></i>
                                @lang('invoice.index.make_payment')
                            </button>
                        </li>
                    </ul>
                </header>
                <h2 class="card-title"> @lang('invoice.title') </h2>
                <small class="dataTables_info"> @lang('invoice.index.short_title_inbox') </small>

                <div class="row">
                    <div class="card card-data-tables product-table-wrapper">
                        <div class="card-body p-0">
                            <table class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th data-orderable="false"></th>
                                        <th>@lang('invoice.index.number')</th>
                                        <th>@lang('invoice.index.amount')</th>
                                        <th>@lang('invoice.index.status')</th>
                                        <th data-orderable="false">@lang('invoice.index.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['invoices'] as $invoice)
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="invoices_id[]" value="{{$invoice->id}}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->amount }}</td>
                                            <td>{{ $invoice->invoiceStatus->message }}</td>
                                            <td>
                                                <a href="#" class="icon" onclick="window.location='{{ route("user.invoices.show", $invoice->id )}}'" data-toggle="tooltip"
                                                   data-placement="top" title="{{__('buttons.titles.show')}}">
                                                    <i class="zmdi zmdi-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </section>


        <section class="tab-pane fadeIn" id="tab-2">
            <h2 class="card-title">@lang('order.index.history')</h2>
            <small class="dataTables_info">@lang('order.index.short_title_history')</small>

            <div class="row">
                <div class="card card-data-tables product-table-wrapper">
                    <div class="card-body p-0">
                        <table class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>@lang('invoice.index.number')</th>
                                <th>@lang('invoice.index.amount')</th>
                                <th>@lang('invoice.index.status')</th>
                                <th data-orderable="false">@lang('invoice.index.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['history'] as $invoice)
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->amount }}</td>
                                    <td>{{ $invoice->invoiceStatus->message }}</td>
                                    <td>
                                        <a href="#" class="icon" onclick="window.location='{{ route("user.invoices.show", $invoice->id )}}'" data-toggle="tooltip"
                                           data-placement="top" title="{{__('buttons.titles.show')}}">
                                            <i class="zmdi zmdi-search"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>
@endsection

        @section('footerJS')
            <script>
                function loadCheckbox() {
                    $('input[type="checkbox"]').each(function () {
                        checkedLength = $('input[type="checkbox"]:checked').length;
                        console.log(checkedLength);
                        if(checkedLength >= 1){
                            $('#make_payment').attr('disabled', false);
                        } else {
                            $('#make_payment').attr('disabled', true);
                        }
                    });
                }

                $('input[type="checkbox"]').click(function () {
                    checkedLength = $('input[type="checkbox"]:checked').length;
                    if ($(this).is(":checked") && checkedLength <= 1) {
                        loadCheckbox();
                    }
                    if (checkedLength <= 0) {
                        loadCheckbox();
                    }
                });
            </script>
        @endsection