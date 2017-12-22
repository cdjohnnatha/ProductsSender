@extends('package.client.sendPackage.send_wizard_layout')


@section('preparePackageWizard')

    @if(Request::is('*/edit'))
        <form action="" role="form" method="POST">
            <input name="_method" type="hidden" value="PUT">
    @else
        <form action="" role="form" method="POST">
    @endif
        {{ csrf_field() }}
            <input type="hidden" name="step" value="{{ $data['step'] }}">
            <section class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    @foreach($data['packages'] as $key => $package)
                        <input type="hidden" name="packages_id[]" value="{{ $package->id }}">

                        @include('package.fragments._collapsible_package_addons',[
                            'index' => $key + 1,
                            'package' => $package,
                            'warehouses' => $data['warehouses'],
                            'tags' => ''
                        ])
                    @endforeach
                        <input type="hidden" name="total_addons" id="total_service_input" value="0.00">
                        <div class="row">
                        <div class="col-xs-6 col-sm-11 text-right ">
                            <span class="block p-b-5 md-text-grey">{{ __('payments.titles.sub_total') }}:</span>
                            <span class="block p-b-5 md-text-grey">{{ __('payments.titles.discount') }}:</span>
                            <span class="block p-b-5 p-t-5">{{ __('payments.titles.total') }}:</span>
                        </div>
                        <div class="col-xs-6 col-sm-1 p-0">
                            <span class="block p-b-5" id="services_first_value">0.00</span>
                            <span class="block p-b-5" id="discount_services">0.00</span>
                            <span class="block p-b-5 cart-total" id="total_services">0.00</span>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="card-footer">
                <ul class="pager wizard">
                    @include('layouts.formButtons.wizard._wizard_buttons', ['tagDisabled' => '', 'finish' => false])
                </ul>
            </footer>
        </form>
@endsection


@section('footerJS')
    <script>
        $('#package_information').removeClass('active');
        $('#package_addon').addClass('active');
    </script>
@endsection