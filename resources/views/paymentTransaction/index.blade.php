@extends('layouts.app')

@section('content')
    <section class="card">
    <header class="card-heading ">
        <h2 class="card-title">@lang('user.transactions.title')</h2>
        <ul class="card-actions right-top">
            <li>
                <a href="{{ route('user.payment_transactions.create') }}" class="btn btn-info btn-flat">
                    <i class="zmdi zmdi-money"></i>
                    @lang('invoice.index.add_payment')
                </a>
            </li>
        </ul>
    </header>
            <div class="card card-data-tables product-table-wrapper">
                <div class="card-body p-0">
                    <table class="mdl-data-table product-table m-t-30" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>@lang('user.transactions.index.amount')</th>
                            <th>@lang('user.transactions.index.payment_type')</th>
                            <th>@lang('user.transactions.index.created_at')</th>
                            <th>@lang('user.transactions.index.updated_at')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['paymentTransaction'] as $transactions)
                            <tr>
                                <td>{{ $transactions->id }}</td>
                                <td>$ {{ $transactions->amount }}</td>
                                <td>$ {{ $transactions->payment_type }}</td>
                                <td>{{ $transactions->created_at }}</td>
                                <td>{{ $transactions->updated_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </section>
@endSection