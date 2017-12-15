<div class="panel-heading" role="tab" id="heading-{{ $index }}">
    <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $index }}"
           aria-expanded="false" aria-controls="collapse-{{ $index }}">
            Package #{{ $packageId }}
        </a>
    </h4>
</div>
<div id="collapse-{{ $index }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-{{ $index }}">
    <div class="panel-body">
        <article>
            <div class="table-responsive border-grey-bottom-1px m-b-20" name="test[]">
                @foreach($warehouses->addons as $addon)
                    <div class="checkbox">
                        <label>

                            <input type="checkbox" class="addons_check" value="{{ $addon->id }}" data-price="{{ $addon->price }}" name="package_addons[{{ $index }}][company_warehouse_addon_id][]">
                            {{$addon->companyAddons->title.' - '}}
                            <small>
                                {{--({{$service->description}}) ---}}
                                <span style="color: black;">{{ __('common.titles.price').': ' }}</span>
                                <span style="color: #388e3c;">+{{ $addon->price }}</span>
                            </small>
                        </label>
                    </div>
                @endforeach
                    <input type="hidden" name="package_addons[{{ $index }}][package_id]" value="{{ $packageId }}">
                <div id="price_addons"></div>
            </div>
        </article>
    </div>
</div>

@section('footerJS')
    @parent
    <script>
        var total, discounts;
        total = parseInt(0);
        $('input[type="checkbox"]').click(function(){
            $(this).each(function(){
                var value = parseFloat($(this).attr('data-price')).toFixed(2);
                console.log(value);
                if($(this).is(":checked")){
                    total = parseFloat(total) + parseFloat(value);
                    console.log('total: ' + total);
                } else {
                    total = parseFloat(total) - parseFloat(value);
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