@extends('package.client.sendPackage.send_wizard_layout')


@section('preparePackageWizard')

    @if(Request::is('*/edit'))
        <form action=" {{ route('user.packages.processPackageWizard') }}" role="form" method="POST">
            <input name="_method" type="hidden" value="PUT">
    @else
        <form action="" role="form" method="POST">
    @endif
            {{ csrf_field() }}
            <input type="hidden" name="step" value="{{ $data['step'] }}">

            @if(isset($data['package_addons']))
                @foreach($data['package_addons'] as $key => $packageAddon)
                    @foreach($packageAddon['company_warehouse_addon_id'] as $addon)
                        <input type="hidden" name="package_addons[{{ $key }}][company_warehouse_addon_id][]" value="{{ $addon }}">
                    @endforeach
                    <input type="hidden" name="package_addons[{{ $key }}][package_id]" value="{{ $packageAddon['package_id'] }}">
                @endforeach
            @endif
            <input type="hidden" name="total_addons" value="{{ $data['total_addons'] }}">
            <input type="hidden" name="company_warehouse_id" value="{{ $data['company_warehouse_id'] }}">
            <section class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    @foreach($data['packages_id'] as $index => $package)
                        <input type="hidden" name="packages_id[]" value="{{ $package }}">
                        <div class="panel-heading" role="tab" id="heading-{{ $index }}">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $index }}"
                                   aria-expanded="false" aria-controls="collapse-{{ $index }}">
                                    Package # {{ $package }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-{{ $index }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-{{ $index }}">
                            <div class="panel-body">
                                <article>
                                    <input type="hidden" name="package_shipment[{{ $index }}][package_id]" value="{{ $package }}">
                                    <div class="table-responsive border-grey-bottom-1px m-b-20" id="table_checkbox">
                                        @foreach($data['rates'][$index] as $rate)
                                            <div class="list-group-item">
                                                <div class="row-content">
                                                    <div class="least-content">
                                                        <span class="checkbox">
                                                          <label>
                                                            <input type="radio" value="{{ $rate->object_id }}" name="package_shipment[{{ $index }}][goshippo_rate_id]" class="shipment_value">
                                                            <input type="hidden" value="{{ $rate->amount }}" name="package_shipment[{{ $index }}][price]" class="shipment_value">
                                                            <input type="hidden" value="{{ Auth::user()->client->defaultAddress->id }}" name="package_shipment[{{ $index }}][client_address_id]" class="shipment_value">
                                                            <input type="hidden" value="{{ $package }}" name="package_shipment[{{ $index }}][package_id]" class="shipment_value">
                                                          </label>
                                                        </span>
                                                    </div>
                                                    <img src="{{ $rate->provider_image_75 }}" alt="">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <caption>Optional table caption.</caption>
                                                            <thead>
                                                            <tr>
                                                                <th>Type</th>
                                                                <th>Amount {{ $rate->currency }}</th>
                                                                <th>Amount {{ $rate->currency_local }}</th>
                                                                <th>Days</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>{{ $rate->provider }}</td>
                                                                <td>{{ $rate->amount }}</td>
                                                                <td>{{ $rate->amount_local }}</td>
                                                                <td>{{ $rate->days }}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </article>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            {{--<shipment-component :addresses="{{ Auth::user()->client->address }}" :rates="{{ json_encode($data['rates'][0]) }}"></shipment-component>--}}

            <footer class="card-footer">
                <ul class="pager wizard">
                    @include('layouts.formButtons.wizard._wizard_buttons', ['tagDisabled' => '', 'finish' => false])
                </ul>
            </footer>
        </form>
@endsection


@section('footerJS')
    <script>
        $('#package_shipment').addClass('active');
        $('#package_addon').removeClass('active');
    </script>
@endsection