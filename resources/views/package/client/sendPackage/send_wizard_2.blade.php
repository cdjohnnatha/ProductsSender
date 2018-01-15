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
                    <input type="hidden" name="company_warehouse_id" value="{{ $data['warehouses']->id }}">
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

        var total, index;
        total = parseInt(0);
        $('input[type="checkbox"]').click(function(){
            console.log($(this));
            $(this).each(function(){
                var value = parseFloat($(this).attr('data-price')).toFixed(2);
                if($(this).is(":checked")){
                    total = parseFloat(total) + parseFloat(value);
                    index = $(this).attr('count-value');
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'addon_package_' + index,
                        name: 'package_addons[' + index + '][package_id]',
                        value: $('#package_id').val() }).appendTo($('#table_checkbox'));
                } else {
                    total = parseFloat(total) - parseFloat(value);
                    index = $(this).attr('package_id_index');
                    $('#addon_package_' + index).remove();
                }
                total = parseFloat(total).toFixed(2);
                updateFields(total);
            });
        });


        function updateTotal() {
            $('.addons_check').each(function(){
                if($(this).is(":checked")){
                    var value = parseFloat($(this).attr('data-price')).toFixed(2);
                    total = parseFloat(total) + parseFloat(value);
                    console.log('total: ' + total);
                }
                total = parseFloat(total).toFixed(2);
                updateFields(total);
            });
        }

        function updateFields(total) {
            $('#services_first_value').html(total);
            $('#total_services').html(total);
            $('#total_service_input').val(total);
        }

        updateTotal();
    </script>
@endsection